<?php
/**
 * Copyright (C) 2019-2021 Carlos Garcia Gomez <carlos@facturascripts.com>
 */

namespace FacturaScripts\Plugins\CSVimport\Lib\Import;

use FacturaScripts\Core\Base\DataBase\DataBaseWhere;
use FacturaScripts\Dinamic\Model\Variante;

/**
 * Description of VariantImport
 *
 * @author Carlos Garcia Gomez <carlos@facturascripts.com>
 * @author Daniel Fernández Giménez <hola@danielfg.es>
 */
class VariantImport extends CsvImporClass
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
        } elseif ($csv->titles[0] === 'codbarras' && $csv->titles[1] === 'coste') {
            return static::TYPE_FACTURASCRIPTS;
        }

        return static::TYPE_NONE;
    }

    protected static function getProfile()
    {
        return 'variants';
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
        $csv = static::getCsv($filePath);

        $numSave = 0;
        $numLines = 0;
        $utils = static::toolBox()->utils();
        foreach ($csv->data as $row) {
            $numLines++;
            // find variant
            $variant = new Variante();
            $where = [new DataBaseWhere('referencia', $utils->noHtml($row['referencia']))];
            if (empty($row['referencia'])
                || $variant->loadFromCode('', $where) && $mode === static::INSERT_MODE
                || false === $variant->loadFromCode('', $where) && $mode === static::UPDATE_MODE) {
                continue;
            }

            /// save new variant
            $variant->loadFromData($row, ['idvariante']);
            if ($variant->save()) {
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
            case static::TYPE_FACTURASCRIPTS:
                return static::importCSVfs($filePath, $mode, $offset);

            default:
                static::toolBox()->i18nLog()->warning('file-not-supported-advanced');
                return ['save' => 0, 'lines' => 0];
        }
    }
}