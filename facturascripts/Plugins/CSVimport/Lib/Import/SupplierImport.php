<?php
/**
 * Copyright (C) 2019-2021 Carlos Garcia Gomez <carlos@facturascripts.com>
 */
namespace FacturaScripts\Plugins\CSVimport\Lib\Import;

use FacturaScripts\Core\Base\DataBase\DataBaseWhere;
use FacturaScripts\Dinamic\Model\CuentaBancoProveedor;
use FacturaScripts\Dinamic\Model\Proveedor;

/**
 * Description of SupplierImport
 *
 * @author Carlos Garcia Gomez <carlos@facturascripts.com>
 */
class SupplierImport extends CsvImporClass
{

    /**
     * 
     * @param string $filePath
     *
     * @return int
     */
    protected static function getFileType(string $filePath): int
    {
        $csv = static::getCsv($filePath);

        if (\count($csv->titles) < 2) {
            return static::TYPE_NONE;
        } elseif ($csv->titles[0] === 'cifnif' && $csv->titles[1] === 'codagente') {
            return static::TYPE_FACTURASCRIPTS;
        } elseif ($csv->titles[0] === 'codproveedor' && $csv->titles[1] === 'nombre') {
            return static::TYPE_FACTURASCRIPTS_2017;
        } elseif ($csv->titles[0] === 'Código' && \in_array('N.I.F.', $csv->titles)) {
            return static::TYPE_FACTUSOL;
        } elseif ($csv->titles[0] === 'Cód' && $csv->titles[1] === 'Nombre') {
            return static::TYPE_FACTUSOL;
        }

        return static::TYPE_NONE;
    }

    /**
     * 
     * @return string
     */
    protected static function getProfile()
    {
        return 'suppliers';
    }

    /**
     * 
     * @param string $filePath
     * @param string $mode
     * @param int $offset
     *
     * @return array
     */
    protected static function importCSVfactusol(string $filePath, string $mode, int $offset): array
    {
        $csv = static::getCsv($filePath, $offset);

        $numSave = 0;
        $numLines = 0;
        foreach ($csv->data as $row) {
            $numLines++;
            /// find supplier
            $supplier = new Proveedor();
            $code = $row['Código'] ?? $row['Cód'];
            if (empty($code)
                || $supplier->loadFromCode($code) && $mode === static::INSERT_MODE
                || false === $supplier->loadFromCode($code) && $mode === static::UPDATE_MODE) {
                continue;
            }

            /// save new supplier
            $supplier->codproveedor = $code;
            $supplier->cifnif = $row['N.I.F.'];
            $supplier->nombre = \substr($row['Nombre comercial'] ?? $row['Nombre'], 0, 100);
            $supplier->telefono1 = $row['Teléfono'];

            /// optional fields
            if (isset($row['E-mail']) && \filter_var(\trim($row['E-mail']), \FILTER_VALIDATE_EMAIL)) {
                $supplier->email = \trim($row['E-mail']);
            }

            if (isset($row['Fax'])) {
                $supplier->fax = $row['Fax'];
            }

            if (isset($row['Móvil'])) {
                $supplier->telefono2 = $row['Móvil'];
            }

            if (isset($row['Nombre fiscal'])) {
                $supplier->razonsocial = \substr($row['Nombre fiscal'], 0, 100);
                if (empty($supplier->nombre)) {
                    $supplier->nombre = $supplier->razonsocial;
                }
            }

            if (false === $supplier->save()) {
                continue;
            }

            $numSave++;
            foreach ($supplier->getAdresses() as $address) {
                $address->direccion = $row['Domicilio'] ?? $row['Dirección'];
                $address->codpostal = $row['Cód. Postal'] ?? $row['C.P.'];
                $address->ciudad = $row['Población'];
                $address->provincia = $row['Provincia'];
                $address->save();
                break;
            }

            if (isset($row['IBAN del banco']) && isset($row['SWIFT del banco'])) {
                static::saveBankAccount($supplier, $row['Banco'], $row['IBAN del banco'], $row['SWIFT del banco']);
            }
        }

        return ['save' => $numSave, 'lines' => $numLines];
    }

    /**
     * 
     * @param string $filePath
     * @param string $mode
     * @param int $offset
     *
     * @return array
     */
    protected static function importCSVfs(string $filePath, string $mode, int $offset): array
    {
        $csv = static::getCsv($filePath, $offset);

        $numSave = 0;
        $numLines = 0;
        foreach ($csv->data as $row) {
            $numLines++;
            /// find supplier
            $supplier = new Proveedor();
            if (empty($row['codproveedor'])
                || $supplier->loadFromCode($row['codproveedor']) && $mode === static::INSERT_MODE
                || false === $supplier->loadFromCode($row['codproveedor']) && $mode === static::UPDATE_MODE) {
                continue;
            }

            /// save new supplier
            $supplier->loadFromData($row, ['codcliente', 'codpago', 'codserie', 'idcontacto']);
            if ($supplier->save()) {
                $numSave++;
            }
        }

        return ['save' => $numSave, 'lines' => $numLines];
    }

    /**
     * 
     * @param string $filePath
     * @param string $mode
     * @param int $offset
     *
     * @return array
     */
    protected static function importCSVfs2017(string $filePath, string $mode, int $offset): array
    {
        $csv = static::getCsv($filePath);

        $numSave = 0;
        $numLines = 0;
        foreach ($csv->data as $row) {
            $numLines++;
            /// find supplier
            $supplier = new Proveedor();
            if (empty($row['codproveedor'])
                || $supplier->loadFromCode($row['codproveedor']) && $mode === static::INSERT_MODE
                || false === $supplier->loadFromCode($row['codproveedor']) && $mode === static::UPDATE_MODE) {
                continue;
            }

            /// save new supplier
            $supplier->loadFromData($row, ['codcliente', 'codpago', 'codserie', 'idcontacto']);

            /// exclude bad emails
            $supplier->email = \trim($supplier->email);
            if (false === \filter_var($supplier->email, \FILTER_VALIDATE_EMAIL)) {
                $supplier->email = '';
            }

            if (false === $supplier->save()) {
                continue;
            }

            $numSave++;
            foreach ($supplier->getAdresses() as $address) {
                $address->direccion = $row['direccion'];
                $address->codpostal = $row['codpostal'];
                $address->ciudad = $row['ciudad'];
                $address->provincia = $row['provincia'];
                $address->codpais = $row['pais'];
                $address->save();
                break;
            }

            static::saveBankAccount($supplier, 'Bank', $row['iban'], $row['swift']);
        }

        return ['save' => $numSave, 'lines' => $numLines];
    }

    /**
     *
     * @param int $type
     * @param string $filePath
     * @param string $mode
     * @param int $offset
     * @param array $params
     * @return array
     */
    protected static function importType(int $type, string $filePath, string $mode, int $offset, array $params): array
    {
        switch ($type) {
            case static::TYPE_FACTUSOL:
                return static::importCSVfactusol($filePath, $mode, $offset);

            case static::TYPE_FACTURASCRIPTS:
                return static::importCSVfs($filePath, $mode, $offset);

            case static::TYPE_FACTURASCRIPTS_2017:
                return static::importCSVfs2017($filePath, $mode, $offset);

            default:
                static::toolBox()->i18nLog()->warning('file-not-supported-advanced');
                return ['save' => 0, 'lines' => 0];
        }
    }

    /**
     * 
     * @param Proveedor $supplier
     * @param string    $bankName
     * @param string    $iban
     * @param string    $swift
     */
    protected static function saveBankAccount($supplier, $bankName, $iban, $swift)
    {
        if (empty($iban) && empty($swift)) {
            return;
        }

        /// Find supplier bank accounts
        $bankAccountModel = new CuentaBancoProveedor();
        $where = [new DataBaseWhere('codproveedor', $supplier->codproveedor)];
        foreach ($bankAccountModel->all($where) as $bank) {
            $bank->descripcion = $bankName;
            $bank->iban = $iban;
            $bank->swift = $swift;
            $bank->save();
            return;
        }

        /// No previous bank accounts? Then create a new one
        $newBank = new CuentaBancoProveedor();
        $newBank->codproveedor = $supplier->codproveedor;
        $newBank->iban = $iban;
        $newBank->swift = $swift;
        $newBank->save();
    }
}
