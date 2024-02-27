<?php
/**
 * Copyright (C) 2022-2023 Carlos Garcia Gomez <carlos@facturascripts.com>
 */

namespace FacturaScripts\Plugins\CSVimport\Lib\Import;

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use DateTime;
use FacturaScripts\Core\Base\ToolBox;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CsvFileTools
{
    public static function convertFileToCsv(string $filePath): string
    {
        if (empty($filePath) || false === file_exists($filePath)) {
            return '';
        }

        // obtenemos la extensión del archivo
        $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

        $mime = mime_content_type($filePath);
        switch ($mime) {
            case 'application/csv':
            case 'text/csv':
            case 'text/plain':
            case 'text/x-Algol68':
                return $filePath;

            case 'application/vnd.ms-excel':
            case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
            case 'application/vnd.oasis.opendocument.spreadsheet':
                return $ext === 'xls' ?
                    self::convertXlsToCsv($filePath) :
                    self::convertOtherToCsv($filePath);

            default:
                return '';
        }
    }

    public static function isBigFile(UploadedFile $uploadFile): bool
    {
        if ($uploadFile->getSize() > 10485760) {
            ToolBox::i18nLog()->warning('file-too-big');
            return true;
        }

        return false;
    }

    public static function isValidFile(string $filePath): bool
    {
        $mime = mime_content_type($filePath);
        switch ($mime) {
            case 'text/csv':
            case 'text/plain':
            case 'text/x-Algol68':
            case 'application/csv':
            case 'application/vnd.ms-excel':
            case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
            case 'application/vnd.oasis.opendocument.spreadsheet':
                return true;

            default:
                $ext = ['csv', 'ods', 'xls', 'xlsx'];
                ToolBox::i18nLog()->warning('unsupported-file-ext', ['%ext%' => implode(', ', $ext)]);
                ToolBox::i18nLog()->warning($mime);
                return false;
        }
    }

    public static function saveUploadFile(UploadedFile $uploadFile): string
    {
        $folder = FS_FOLDER . DIRECTORY_SEPARATOR . 'MyFiles';
        return $uploadFile->move($folder, $uploadFile->getClientOriginalName())->getRealPath();
    }

    protected static function convertOtherToCsv(string $filePath): string
    {
        // leemos el excel
        $reader = ReaderEntityFactory::createReaderFromFile($filePath);
        $reader->open($filePath);

        // abrimos el csv
        $pathCsv = FS_FOLDER . DIRECTORY_SEPARATOR . 'MyFiles' . DIRECTORY_SEPARATOR . pathinfo($filePath, PATHINFO_FILENAME) . '.csv';
        $file = fopen($pathCsv, 'w');

        // recorremos las filas
        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as $row) {
                $newRow = [];
                foreach ($row->getCells() as $cell) {
                    // si el valor es dateTime, lo convertimos a string
                    $value = $cell->getValue();
                    if ($value instanceof DateTime) {
                        $newRow[] = $value->format('d-m-Y');
                        continue;
                    }

                    $newRow[] = $value;
                }

                fputcsv($file, $newRow);
            }
            break;
        }

        // cerramos los archivos
        $reader->close();
        fclose($file);

        // eliminamos el archivo original
        unlink($filePath);

        return $pathCsv;
    }

    protected static function convertXlsToCsv(string $filePath): string
    {
        $reader = IOFactory::createReader(IOFactory::identify($filePath));
        $reader->setReadEmptyCells(false);

        // recorremos todas las columnas y cambiamos las de tipo fecha a texto
        $spreadsheet = $reader->load($filePath);
        foreach ($spreadsheet->getActiveSheet()->getRowIterator() as $row) {
            foreach ($row->getCellIterator() as $cell) {
                if ($cell->getDataType() === DataType::TYPE_NUMERIC) {
                    $cell->setValueExplicit($cell->getValue(), DataType::TYPE_STRING);
                }
            }
            break;
        }

        // convertimos el excel a csv
        $pathCsv = FS_FOLDER . DIRECTORY_SEPARATOR . 'MyFiles' . DIRECTORY_SEPARATOR . pathinfo($filePath, PATHINFO_FILENAME) . '.csv';
        $writer = IOFactory::createWriter($spreadsheet, 'Csv');
        $writer->setSheetIndex(0);
        $writer->setDelimiter(';');
        $writer->save($pathCsv);

        // liberamos memoria
        $spreadsheet->disconnectWorksheets();
        $spreadsheet->garbageCollect();
        unset($spreadsheet);

        // eliminamos el excel
        unlink($filePath);

        // leemos el csv para comprobar si tiene fechas no válidas
        $file = fopen($pathCsv, 'r');
        $invalidDate = false;
        while (false !== ($line = fgetcsv($file, 0, ';'))) {
            foreach ($line as $value) {
                // comprobamos si hay fechas
                $matches = [];
                if (!preg_match('/^(\d{1,2})\/(\d{1,2})\/(\d{4})$/', $value, $matches)) {
                    continue;
                }

                $date = DateTime::createFromFormat('d/m/Y', $value);
                if ($date === false) {
                    $invalidDate = true;
                    break 2;
                }
            }
        }

        // si hay fechas no válidas, las corregimos
        if ($invalidDate) {
            rewind($file);
            $csv = '';
            while (false !== ($line = fgetcsv($file, 0, ';'))) {
                $csv .= self::fixDateOnCsvLine($line) . PHP_EOL;
            }
            fclose($file);
            file_put_contents($pathCsv, $csv);
        }

        return $pathCsv;
    }

    protected static function fixDateOnCsvLine(array $line): string
    {
        $result = [];
        foreach ($line as $value) {
            if (preg_match('/^(\d{1,2})\/(\d{1,2})\/(\d{4})$/', $value, $matches)) {
                $result[] = str_pad($matches[2], 2, '0', STR_PAD_LEFT)
                    . '-' . str_pad($matches[1], 2, '0', STR_PAD_LEFT)
                    . '-' . $matches[3];
                continue;
            }

            $result[] = $value;
        }

        return implode(';', $result);
    }
}