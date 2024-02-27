<?php
/**
 * Copyright (C) 2023 Carlos Garcia Gomez <carlos@facturascripts.com>
 */

namespace FacturaScripts\Plugins\CSVimport\Lib\ImportProfile;

use FacturaScripts\Core\Base\DataBase\DataBaseWhere;
use FacturaScripts\Plugins\ConciliacionBancaria\Model\MovimientoBanco;

/**
 * Description of BankingMovementsProfile
 *
 * @author Daniel Fernandez Giménez <hola@danielfg.es>
 */
class BankingMovementsProfile extends ProfileClass
{
    public function getDataFields(): array
    {
        return [
            'cuentasbanco_movimientos.amount' => ['title' => 'amount'],
            'cuentasbanco_movimientos.date' => ['title' => 'date'],
            'cuentasbanco_movimientos.observations' => ['title' => 'observations'],
        ];
    }

    protected function getFileType(): string
    {
        return self::METHOD_IMPORT;
    }

    public static function getProfile(): string
    {
        return 'banking-movements';
    }

    protected function importItem(array $item): bool
    {
        // comprobamos si existe un movimiento bancario con los mismos campos
        $whereMovement = [new DataBaseWhere('codcuenta', $this->model->codcuenta),];
        foreach (static::getDataFields() as $field => $data) {
            // si el field contiene "cuentasbanco_movimientos." lo añadimos
            if (str_contains($field, 'cuentasbanco_movimientos.')
                && isset($item[$field]) && false === empty($item[$field])) {
                $whereMovement[] = new DataBaseWhere($field, $item[$field]);
            }
        }

        $bankingMovement = new MovimientoBanco();
        if ($bankingMovement->loadFromCode('', $whereMovement) && $this->model->mode === static::INSERT_MODE
            || false === $bankingMovement->loadFromCode('', $whereMovement) && $this->model->mode === static::UPDATE_MODE) {
            return false;
        }

        if (false === $this->setModelValues($bankingMovement, $item, 'cuentasbanco_movimientos.')) {
            return false;
        }
        if (empty($bankingMovement->codcuenta)) {
            $bankingMovement->codcuenta = $this->model->codcuenta;
        }
        if (empty($bankingMovement->reconciled) || false === is_bool($bankingMovement->reconciled)) {
            $bankingMovement->reconciled = false;
        }

        return $bankingMovement->save();
    }
}