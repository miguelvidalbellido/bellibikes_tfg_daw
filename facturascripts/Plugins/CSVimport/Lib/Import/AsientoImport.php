<?php
/**
 * Copyright (C) 2019-2022 Carlos Garcia Gomez <carlos@facturascripts.com>
 */

namespace FacturaScripts\Plugins\CSVimport\Lib\Import;

use DateTime;
use FacturaScripts\Core\Base\DataBase\DataBaseWhere;
use FacturaScripts\Dinamic\Model\Asiento;
use FacturaScripts\Dinamic\Model\Ejercicio;
use FacturaScripts\Dinamic\Model\Partida;
use FacturaScripts\Dinamic\Model\Subcuenta;

/**
 * Description of AsientoImport
 *
 * @author Carlos Garcia Gomez <carlos@facturascripts.com>
 * @author Daniel Fernández Giménez <hola@danielfg.es>
 */
class AsientoImport extends CsvImporClass
{

    protected static function getFileType(string $filePath)
    {
        $csv = static::getCsv($filePath);

        if (count($csv->titles) < 3) {
            return static::TYPE_NONE;
        } elseif ($csv->titles[0] === 'Asiento' && $csv->titles[1] === 'Fecha' && $csv->titles[2] === 'Cuenta') {
            return static::TYPE_SAGE;
        }

        return static::TYPE_NONE;
    }

    protected static function getProfile()
    {
        return 'accounting-entries';
    }

    /**
     * @param string $filePath
     * @param string $mode
     * @param int $offset
     *
     * @return array
     */
    protected static function importCSVsage(string $filePath, string $mode, int $offset): array
    {
        $csv = static::getCsv($filePath, $offset);

        $numSave = 0;
        $numLines = 0;
        $utils = static::toolBox()->utils();
        foreach ($csv->data as $row) {
            $numLines++;
            // busca si existe la subcuenta, si no existe paramos la ejecución
            $subaccount = new Subcuenta();
            $where = [new DataBaseWhere('codsubcuenta', $row['Cuenta'])];
            if (false === $subaccount->loadFromCode('', $where)) {
                static::toolBox()->i18nlog()->error('subaccount-not-found', ['%subAccountCode%' => $row['Cuenta']]);
                return ['save' => $numSave, 'lines' => $numLines];
            }

            // obtener año de la fecha de la partida
            $date = DateTime::createFromFormat('d/m/Y', $row['Fecha']);
            $fecha = $date->format('Y-m-d');
            $year = $date->format('Y');

            // busca si existe el ejercicio, si no existe lo crea
            $exercise = new Ejercicio();
            $where = [
                new DataBaseWhere('fechainicio', $year . '-01-01'),
                new DataBaseWhere('fechafin', $year . '-12-31')
            ];
            if (false === $exercise->loadFromCode('', $where)) {
                $exercise->codejercicio = $year;
                $exercise->nombre = $year;
                $exercise->fechainicio = $year . '-01-01';
                $exercise->fechafin = $year . '-12-31';
                if (false === $exercise->save()) {
                    continue;
                }
            }

            // busca si existe el asiento
            $entry = new Asiento();
            $where = [
                new DataBaseWhere('fecha', $fecha),
                new DataBaseWhere('documento', $row['Asiento'])
            ];
            if (false === $entry->loadFromCode('', $where)) {
                // no existe, lo creamos
                $entry->codejercicio = $exercise->codejercicio;
                $entry->concepto = $utils->noHtml($row['Concepto']);
                if ($row['Concepto'] === 'ASIENTO DE APERTURA') {
                    $entry->operacion = $entry::OPERATION_OPENING;
                }
                $entry->documento = $row['Asiento'];
                $entry->fecha = $fecha;
                $entry->importe = max([self::getFloat($row['Debe']), self::getFloat($row['Haber'])]);
                if (false === $entry->save()) {
                    self::toolBox()::log()->error('Error al crear el asiento ' . $row['Asiento']);
                    continue;
                }
            }

            // busca si existe la partida dentro del asiento
            $line = new Partida();
            $where = [
                new DataBaseWhere('idasiento', $entry->idasiento),
                new DataBaseWhere('documento', $row['Linea'])
            ];
            if ($line->loadFromCode('', $where) && $mode === static::INSERT_MODE
                || false === $line->loadFromCode('', $where) && $mode === static::UPDATE_MODE) {
                continue;
            }

            $line->idasiento = $entry->idasiento;
            $line->concepto = $utils->noHtml($row['Concepto']);
            $line->codsubcuenta = $utils->noHtml($row['Cuenta']);
            $line->idsubcuenta = $subaccount->idsubcuenta;
            $line->debe = self::getFloat($row['Debe']);
            $line->haber = self::getFloat($row['Haber']);
            $line->tasaconv = self::getFloat($row['Cambio']);
            $line->documento = $row['Linea'];
            if (false === $line->save()) {
                self::toolBox()::log()->error('Error al crear la línea del asiento ' . $row['Asiento']);
                continue;
            }

            $numSave++;
        }

        return ['save' => $numSave, 'lines' => $numLines];
    }

    /**
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
            case static::TYPE_SAGE:
                return static::importCSVsage($filePath, $mode, $offset);

            default:
                static::toolBox()->i18nLog()->warning('file-not-supported-advanced');
                return ['save' => 0, 'lines' => 0];
        }
    }
}