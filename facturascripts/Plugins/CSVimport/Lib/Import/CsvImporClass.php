<?php
/**
 * Copyright (C) 2019-2022 Carlos Garcia Gomez <carlos@facturascripts.com>
 */

namespace FacturaScripts\Plugins\CSVimport\Lib\Import;

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Exception;
use FacturaScripts\Core\Base\DataBase;
use FacturaScripts\Core\Base\DataBase\DataBaseWhere;
use FacturaScripts\Core\Base\ToolBox;
use FacturaScripts\Core\DataSrc\Impuestos;
use FacturaScripts\Core\Model\Base\BusinessDocumentLine;
use FacturaScripts\Core\Model\Base\ModelCore;
use FacturaScripts\Dinamic\Model\FacturaCliente;
use FacturaScripts\Dinamic\Model\Impuesto;
use FacturaScripts\Dinamic\Model\Pais;
use FacturaScripts\Dinamic\Model\Serie;
use FacturaScripts\Plugins\CSVimport\Model\CSVfile;
use ParseCsv\Csv;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Description of CsvImporClass
 *
 * @author Carlos Garcia Gomez <carlos@facturascripts.com>
 */
abstract class CsvImporClass
{
    const ADVANCED_MODE = 'advanced';
    const INSERT_MODE = 'insert';
    const UPDATE_MODE = 'update';
    const INSERT_UPDATE_MODE = 'insert-update';
    const TYPE_FACTURASCRIPTS = 1;
    const TYPE_FACTURASCRIPTS_2017 = 2;
    const TYPE_FACTUSOL = 3;
    const TYPE_SAGE = 4;
    const TYPE_GOOGLE = 5;
    const TYPE_OUTLOOK = 6;
    const TYPE_NONE = 0;
    const LIMIT_IMPORT = 1000;

    /**
     * @var Csv
     */
    protected static $csv;

    /**
     * @var Impuesto[]
     */
    protected static $impuestos;

    /**
     * @var array
     */
    protected static $invoiceDates = [];

    /**
     * @var int
     */
    protected static $limit = self::LIMIT_IMPORT;

    /**
     * @var int
     */
    protected static $offset = 0;

    /**
     * @var Serie[]
     */
    protected static $series = [];

    abstract protected static function getFileType(string $filePath);

    abstract protected static function getProfile();

    abstract protected static function importType(int $type, string $filePath, string $mode, int $offset, array $params);

    /**
     * @param string $fileName
     *
     * @return CSVfile|null
     */
    public static function advancedImport(string $fileName): ?CSVfile
    {
        $newCsvFile = new CSVfile();
        $filePath = static::getFilePath($fileName);

        if (empty($filePath)) {
            static::toolBox()->i18nLog()->warning('file-not-found', ['%fileName%' => $filePath]);
            return null;
        }

        $newCsvFile->path = $fileName;
        $newCsvFile->profile = static::getProfile();
        $newCsvFile->save();
        return $newCsvFile;
    }

    public static function deleteFile($fileName)
    {
        $filePath = static::getFilePath($fileName);
        if (false === empty($filePath)) {
            unlink($filePath);
        }
    }

    public static function getTotalCsv($fileName): int
    {
        $csv = static::getCsv(static::getFilePath($fileName));
        return count($csv->data);
    }

    /**
     * @param string $fileName
     * @param string $mode
     * @param int $offset
     * @param int $total
     * @param array $params
     * @return array
     */
    public static function importCSV(string $fileName, string $mode, int $offset, int $total, array $params = []): array
    {
        $result = [
            'save' => 0,
            'offset' => $offset,
            'total' => $total
        ];

        $filePath = static::getFilePath($fileName);
        if (empty($filePath)) {
            static::toolBox()->i18nLog()->warning('file-not-found', ['%fileName%' => $filePath]);
            return $result;
        }

        // start transaction
        $dataBase = new DataBase();
        $dataBase->beginTransaction();

        try {
            $type = static::getFileType($filePath);
            $process = static::importType($type, $filePath, $mode, $offset + 1, $params);
            $result['offset'] += $process['lines'];
            $result['save'] += $process['save'];

            // confirm data
            $dataBase->commit();
        } catch (Exception $exp) {
            static::toolBox()->log()->error($exp->getLine() . ': ' . $exp->getMessage());
        } finally {
            if ($dataBase->inTransaction()) {
                $dataBase->rollback();
            }
        }

        return $result;
    }

    /**
     * @param UploadedFile $uploadFile
     *
     * @return bool
     */
    public static function isValidFile($uploadFile): bool
    {
        $ext = ['csv', 'xls', 'xlsx', 'ods'];
        if (in_array($uploadFile->getClientOriginalExtension(), $ext)) {
            return true;
        }

        switch ($uploadFile->getMimeType()) {
            case 'application/octet-stream':
                ToolBox::i18nLog()->warning('unsupported-file-ext', ['%ext%' => implode(', ', $ext)]);
                return false;

            case 'text/csv':
            case 'text/plain':
            case 'text/x-Algol68':
            case 'application/vnd.ms-excel':
            case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
            case 'application/vnd.oasis.opendocument.spreadsheet':
                return true;

            default:
                return false;
        }
    }

    /**
     * @param UploadedFile $uploadFile
     *
     * @return bool
     */
    public static function saveUploadFile($uploadFile): bool
    {
        $ext = $uploadFile->getClientOriginalExtension();

        switch ($ext) {
            case 'csv':
                return (bool)$uploadFile->move(FS_FOLDER . DIRECTORY_SEPARATOR . 'MyFiles', $uploadFile->getClientOriginalName());

            case 'ods':
                $reader = ReaderEntityFactory::createODSReader();
                break;

            case 'xls':
            case 'xlsx':
                $reader = ReaderEntityFactory::createXLSXReader();
                break;

            default:
                return false;
        }

        $writer = WriterEntityFactory::createCSVWriter();
        $writer->openToFile(FS_FOLDER . DIRECTORY_SEPARATOR . 'MyFiles' . DIRECTORY_SEPARATOR . pathinfo($uploadFile->getClientOriginalName(), PATHINFO_FILENAME) . '.csv');
        $reader->open($uploadFile->getPathname());

        // convertimos solamente el contenido de la hoja 1
        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as $row) {
                $writer->addRow($row);
            }
            break;
        }

        $writer->close();
        $reader->close();

        return true;
    }

    /**
     * @param FacturaCliente $invoice
     */
    protected static function checkInvoiceDate(&$invoice)
    {
        // undefined?
        if (false === isset(static::$invoiceDates[$invoice->codejercicio][$invoice->codserie])) {
            static::$invoiceDates[$invoice->codejercicio][$invoice->codserie] = strtotime($invoice->fecha);
            return;
        }

        // lower date?
        if (strtotime($invoice->fecha) < static::$invoiceDates[$invoice->codejercicio][$invoice->codserie]) {
            $newDate = date(FacturaCliente::DATE_STYLE, static::$invoiceDates[$invoice->codejercicio][$invoice->codserie]);
            static::toolBox()->i18nLog()->warning('invoice-date-changed', ['%old%' => $invoice->fecha, '%new%' => $newDate]);
            $invoice->fecha = $newDate;
            return;
        }

        // upper date
        static::$invoiceDates[$invoice->codejercicio][$invoice->codserie] = strtotime($invoice->fecha);
    }

    /**
     * @param string $code
     *
     * @return Pais
     */
    protected static function getCountry($code)
    {
        $country = new Pais();
        if ($country->loadFromCode($code)) {
            return $country;
        }

        $where = [new DataBaseWhere('codiso', $code)];
        $country->loadFromCode('', $where);
        return $country;
    }

    /**
     * @param string $filePath
     * @param int|null $offset
     *
     * @return Csv
     */
    protected static function getCsv(string $filePath, int $offset = null): Csv
    {
        if (is_null($offset)) {
            $csv = new Csv();
        } else {
            $csv = new Csv(null, $offset, static::LIMIT_IMPORT);
        }

        $csv->auto($filePath);
        return $csv;
    }

    protected static function getFilePath($fileName): string
    {
        $filePath = FS_FOLDER . DIRECTORY_SEPARATOR . 'MyFiles' . DIRECTORY_SEPARATOR . $fileName;
        if (false === file_exists($filePath)) {
            static::toolBox()->i18nLog()->warning('file-not-found', ['%fileName%' => $filePath]);
            return '';
        }

        return $filePath;
    }

    /**
     * @param string $text
     *
     * @return string
     */
    protected static function getFixedDate($text)
    {
        if (empty($text)) {
            return date(ModelCore::DATE_STYLE);
        }

        // comprobamos si el separador de fecha es / o -
        $sep = strpos($text, '/') !== false ? '/' : '-';

        // partimos la fecha, si no hay 3 trozos, devolvemos la fecha actual
        $parts = explode($sep, $text);
        if (count($parts) !== 3) {
            return date(ModelCore::DATE_STYLE);
        }

        // si el tercer valor tiene 4 dígitos no hacemos nada, si tiene 2 y es mayor que 80, le sumamos 1900, sino 2000
        if (strlen($parts[2]) === 2) {
            $parts[2] = (int)$parts[2] > 80 ? '19' . $parts[2] : '20' . $parts[2];
        }

        // componemos la nueva fecha
        $newText = $parts[2] . '-' . $parts[1] . '-' . $parts[0];
        return date(ModelCore::DATE_STYLE, strtotime($newText));
    }

    /**
     * @param float $totalIva
     * @param float $net
     *
     * @return float
     */
    protected static function getFactusolIVA($totalIva, $net)
    {
        if (empty(static::getFloat($net)) || empty(static::getFloat($net))) {
            return 0.0;
        }

        return static::getFloat($totalIva) * 100 / static::getFloat($net);
    }

    /**
     * @param string $value
     *
     * @return float
     */
    protected static function getFloat($value): float
    {
        // si hay coma y punto, cambiamos el punto por nada
        if (strpos($value, ',') !== false && strpos($value, '.') !== false) {
            $value = str_replace('.', '', $value);
        }

        // cambiamos la coma por punto
        return (float)str_replace(',', '.', $value);
    }

    /**
     * @param string $value
     *
     * @return Serie
     */
    protected static function getSerie($value): Serie
    {
        // find serie on the list
        if (isset(static::$series[$value])) {
            return static::$series[$value];
        }

        // find serie on database
        $serie = new Serie();
        if (false === $serie->loadFromCode($value)) {
            // create new serie
            $serie->codserie = $value;
            $serie->descripcion = 'FactuSol #' . $value;
            if ($serie->save()) {
                static::$series[$value] = $serie;
            }
        }

        return $serie;
    }

    /**
     * @param BusinessDocumentLine $line
     * @param float $net
     * @param float $totalIva
     * @param float $re
     */
    protected static function setFactusolIVA(&$line, $net, $totalIva, $re)
    {
        $line->codimpuesto = null;
        $line->iva = static::getFactusolIVA($totalIva, $net);
        $line->pvpunitario = static::getFloat($net);
        $line->recargo = static::getFactusolIVA($re, $net);

        foreach (Impuestos::all() as $imp) {
            $subtotal = $line->pvpunitario * $imp->iva / 100;
            if (abs($subtotal - static::getFloat($totalIva)) < 0.01) {
                $line->codimpuesto = $imp->codimpuesto;
                $line->iva = $imp->iva;
                $line->recargo = static::getFactusolIVA($re, $net);
                break;
            }
        }
    }

    protected static function toolBox(): ToolBox
    {
        return new ToolBox();
    }
}
