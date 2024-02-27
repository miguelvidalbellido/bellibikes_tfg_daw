<?php
/**
 * Copyright (C) 2019-2020 Carlos Garcia Gomez <carlos@facturascripts.com>
 */
namespace FacturaScripts\Plugins\CSVimport\Lib\Import;

use FacturaScripts\Core\Base\DataBase\DataBaseWhere;
use FacturaScripts\Dinamic\Model\Fabricante;

/**
 * Description of ManufacturerImport
 *
 * @author Carlos Garcia Gomez <carlos@facturascripts.com>
 */
class ManufacturerImport extends CsvImporClass
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
        } elseif ($csv->titles[0] === 'codfabricante' && $csv->titles[1] === 'nombre') {
            return static::TYPE_FACTURASCRIPTS_2017;
        }

        return static::TYPE_NONE;
    }

    /**
     * 
     * @return string
     */
    protected static function getProfile()
    {
        return 'manufacturers';
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
        $csv = static::getCsv($filePath, $offset);

        $numSave = 0;
        $numLines = 0;
        $utils = static::toolBox()->utils();
        foreach ($csv->data as $row) {
            $numLines++;
            $manufacturer = new Fabricante();
            $where = [new DataBaseWhere('codfabricante', $utils->noHtml($row['codfabricante']))];
            if (empty($row['codfabricante'])
                || $manufacturer->loadFromCode('', $where) && $mode === static::INSERT_MODE
                || false === $manufacturer->loadFromCode('', $where) && $mode === static::UPDATE_MODE) {
                /// manufacturer found
                continue;
            }

            $manufacturer->loadFromData($row);
            if ($manufacturer->save()) {
                $numSave++;
            }
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
            case static::TYPE_FACTURASCRIPTS_2017:
                return static::importCSVfs2017($filePath, $mode, $offset);

            default:
                static::toolBox()->i18nLog()->warning('file-not-supported-advanced');
                return ['save' => 0, 'lines' => 0];
        }
    }
}
