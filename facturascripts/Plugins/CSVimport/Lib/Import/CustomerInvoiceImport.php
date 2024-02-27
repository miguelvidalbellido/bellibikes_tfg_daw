<?php
/**
 * Copyright (C) 2019-2022 Carlos Garcia Gomez <carlos@facturascripts.com>
 */

namespace FacturaScripts\Plugins\CSVimport\Lib\Import;

use FacturaScripts\Core\Base\Calculator;
use FacturaScripts\Core\Base\DataBase\DataBaseWhere;
use FacturaScripts\Dinamic\Model\Cliente;
use FacturaScripts\Dinamic\Model\FacturaCliente;

/**
 * Description of CustomerInvoiceImport
 *
 * @author Carlos Garcia Gomez <carlos@facturascripts.com>
 */
class CustomerInvoiceImport extends CsvImporClass
{
    protected static function getFactusolCustomer(array $line): Cliente
    {
        // get code
        $parts = explode('-', $line['Cliente']);
        $code = (int)$parts[0];
        if (empty($code)) {
            $code = 99999;
        }

        $customer = new Cliente();
        if (false === $customer->loadFromCode($code)) {
            // save new customer
            $customer->cifnif = '';
            $customer->codcliente = $code;
            $customer->nombre = empty($parts[1]) ? '-' : $parts[1];
            $customer->save();
        }

        return $customer;
    }

    protected static function getFileType(string $filePath): int
    {
        $csv = static::getCsv($filePath);

        if (count($csv->titles) < 2) {
            return static::TYPE_NONE;
        } elseif ($csv->titles[0] === 'S.' && $csv->titles[3] === 'Cliente') {
            return static::TYPE_FACTUSOL;
        }

        return static::TYPE_NONE;
    }

    protected static function getProfile(): string
    {
        return 'customer-invoices';
    }

    protected static function importCSVfactusol(string $filePath, string $mode, int $offset): array
    {
        $csv = static::getCsv($filePath, $offset);

        $numSave = 0;
        $numLines = 0;
        foreach ($csv->data as $row) {
            $numLines++;
            if (empty($row['S.'])) {
                continue;
            }

            // find invoice
            $invoice = new FacturaCliente();
            $where = [
                new DataBaseWhere('codserie', $row['S.']),
                new DataBaseWhere('numero', (int)$row['Num.']),
            ];
            if ($invoice->loadFromCode('', $where) && $mode === static::INSERT_MODE) {
                // force date checking
                static::checkInvoiceDate($invoice);
                continue;
            } elseif (false === $invoice->loadFromCode('', $where) && $mode === static::UPDATE_MODE) {
                continue;
            }

            // save new invoice
            $invoice->setSubject(static::getFactusolCustomer($row));
            $invoice->codserie = static::getSerie($row['S.'])->codserie;
            $invoice->setDate(static::getFixedDate($row['Fecha']), date('H:i:s'));
            $invoice->numero = (int)$row['Num.'];
            static::checkInvoiceDate($invoice);
            if (false === $invoice->save()) {
                break;
            }

            $numSave++;
            $newLine = $invoice->getNewLine();
            $newLine->descripcion = $row['Cliente'];
            static::setFactusolIVA($newLine, $row['Base'], $row['IVA'], $row['Rec.']);
            $newLine->save();

            $lines = $invoice->getLines();
            Calculator::calculate($invoice, $lines, false);
            if (abs($invoice->total - static::getFloat($row['Total'])) > 0.01) {
                static::toolBox()->i18nLog()->warning('total-value-error', [
                    '%docType%' => $invoice->modelClassName(),
                    '%docCode%' => $invoice->codigo,
                    '%docTotal%' => $invoice->total,
                    '%calcTotal%' => static::getFloat($row['Total'])
                ]);
            }

            $invoice->save();

            // paid invoice?
            if ($row['Est.'] === 'Cobra') {
                foreach ($invoice->getReceipts() as $receipt) {
                    $receipt->fechapago = $invoice->fecha;
                    $receipt->pagado = true;
                    $receipt->save();
                }
            }
        }

        return ['save' => $numSave, 'lines' => $numLines];
    }

    protected static function importType(int $type, string $filePath, string $mode, int $offset, array $params): array
    {
        switch ($type) {
            case static::TYPE_FACTUSOL:
                return static::importCSVfactusol($filePath, $mode, $offset);

            default:
                static::toolBox()->i18nLog()->warning('file-not-supported-advanced');
                return ['save' => 0, 'lines' => 0];
        }
    }
}
