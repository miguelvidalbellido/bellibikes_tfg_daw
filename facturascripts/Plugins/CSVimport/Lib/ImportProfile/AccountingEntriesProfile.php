<?php
/**
 * Copyright (C) 2020-2023 Carlos Garcia Gomez <carlos@facturascripts.com>
 */

namespace FacturaScripts\Plugins\CSVimport\Lib\ImportProfile;

use FacturaScripts\Core\Base\DataBase\DataBaseWhere;
use FacturaScripts\Dinamic\Model\Asiento;
use FacturaScripts\Dinamic\Model\Ejercicio;
use FacturaScripts\Dinamic\Model\Partida;
use FacturaScripts\Dinamic\Model\Subcuenta;

/**
 * Description of AccountingEntriesProfile
 *
 * @author Carlos Garcia Gomez      <carlos@facturascripts.com>
 * @author Daniel Fernandez Giménez <hola@danielfg.es>
 */
class AccountingEntriesProfile extends ProfileClass
{
    public function getDataFields(): array
    {
        return [
            'asiento' => ['title' => 'accounting-entry'],
            'linea' => ['title' => 'line'],
            'fecha' => ['title' => 'date'],
            'concepto' => ['title' => 'concept'],
            'cuenta' => ['title' => 'account'],
            'debe' => ['title' => 'debit'],
            'haber' => ['title' => 'credit']
        ];
    }

    protected function getFileType(): string
    {
        return self::METHOD_IMPORT;
    }

    public static function getProfile(): string
    {
        return 'accounting-entries';
    }

    protected function importItem(array $item): bool
    {
        $fieldRequired = ['cuenta', 'debe', 'haber', 'fecha', 'concepto', 'asiento'];
        foreach ($fieldRequired as $field) {
            if (false === isset($item[$field])) {
                $this->toolBox()->i18nLog()->warning('field-required', ['%field%' => $field]);
                return false;
            }
        }

        // obtener año de la fecha de la partida
        $fecha = $this->getDate($item['fecha']);
        $year = date('Y', strtotime($fecha));

        // busca si existe el ejercicio, si no existe lo crea
        $exercise = new Ejercicio();
        $whereExercise = [
            new DataBaseWhere('fechainicio', $year . '-01-01'),
            new DataBaseWhere('fechafin', $year . '-12-31')
        ];
        if (false === $exercise->loadFromCode('', $whereExercise)) {
            $exercise->codejercicio = $year;
            $exercise->nombre = $year;
            $exercise->fechainicio = $year . '-01-01';
            $exercise->fechafin = $year . '-12-31';
            if (false === $exercise->save()) {
                self::toolBox()::log()->error('Error al crear el ejercicio para el año ' . $year);
                return false;
            }
        }

        // busca si existe la subcuenta, si no existe paramos la ejecución
        $subaccount = new Subcuenta();
        $whereAccount = [
            new DataBaseWhere('codsubcuenta', $item['cuenta']),
            new DataBaseWhere('codejercicio', $exercise->codejercicio)
        ];
        if (false === $subaccount->loadFromCode('', $whereAccount)) {
            self::toolBox()->i18nlog()->error('subaccount-not-found', ['%subAccountCode%' => $item['cuenta']]);
            return false;
        }

        // busca si existe el asiento
        $entry = new Asiento();
        $where = [
            new DataBaseWhere('codejercicio', $exercise->codejercicio),
            new DataBaseWhere('fecha', $fecha),
            new DataBaseWhere('documento', $item['asiento'])
        ];
        if (false === $entry->loadFromCode('', $where)) {
            // no existe, lo creamos
            $entry->codejercicio = $exercise->codejercicio;
            $entry->concepto = self::toolBox()->utils()->noHtml($item['concepto']);
            if ($item['concepto'] === 'ASIENTO DE APERTURA') {
                $entry->operacion = $entry::OPERATION_OPENING;
            }
            $entry->documento = $item['asiento'];
            $entry->fecha = $fecha;
            $entry->importe = max([self::getFloat($item['debe']), self::getFloat($item['haber'])]);
            if (false === $entry->save()) {
                self::toolBox()::log()->error('Error al crear el asiento ' . $item['asiento']);
                return false;
            }
        }

        // busca si existe la partida dentro del asiento
        $line = new Partida();
        $where = [new DataBaseWhere('idasiento', $entry->idasiento),];

        if (isset($item['linea']) && false === empty($item['linea'])) {
            $where[] = new DataBaseWhere('documento', $item['linea']);
        } else {
            $where[] = new DataBaseWhere('codsubcuenta', $item['cuenta']);
            $where[] = new DataBaseWhere('debe', self::getFloat($item['debe']));
            $where[] = new DataBaseWhere('haber', self::getFloat($item['haber']));
        }

        if ($line->loadFromCode('', $where) && $this->model->mode === static::INSERT_MODE
            || false === $line->loadFromCode('', $where) && $this->model->mode === static::UPDATE_MODE) {
            return false;
        }

        $line->idasiento = $entry->idasiento;
        $line->concepto = self::toolBox()->utils()->noHtml($item['concepto']);
        $line->codsubcuenta = self::toolBox()->utils()->noHtml($item['cuenta']);
        $line->idsubcuenta = $subaccount->idsubcuenta;
        $line->debe = self::getFloat($item['debe']);
        $line->haber = self::getFloat($item['haber']);
        $line->documento = $item['linea'] ?? '';
        if (false === $line->save()) {
            self::toolBox()::log()->error('Error al crear la línea del asiento ' . $item['asiento']);
            return false;
        }

        return true;
    }
}