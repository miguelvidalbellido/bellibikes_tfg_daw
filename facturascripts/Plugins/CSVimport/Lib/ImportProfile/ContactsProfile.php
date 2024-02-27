<?php
/**
 * Copyright (C) 2020-2022 Carlos Garcia Gomez <carlos@facturascripts.com>
 */

namespace FacturaScripts\Plugins\CSVimport\Lib\ImportProfile;

use FacturaScripts\Core\Base\DataBase\DataBaseWhere;
use FacturaScripts\Core\DataSrc\Agentes;
use FacturaScripts\Core\DataSrc\Paises;
use FacturaScripts\Core\Model\Base\ModelClass;
use FacturaScripts\Dinamic\Model\Contacto;
use FacturaScripts\Dinamic\Model\Pais;

/**
 * Description of ContactsProfile
 *
 * @author Daniel Fernández Giménez <hola@danielfg.es>
 */
class ContactsProfile extends ProfileClass
{
    public function getDataFields(): array
    {
        return [
            'contactos.idcontacto' => ['title' => 'code'],
            'contactos.nombre' => ['title' => 'name'],
            'contactos.apellidos' => ['title' => 'surname'],
            'contactos.tipoidfiscal' => ['title' => 'fiscal-id'],
            'contactos.cifnif' => ['title' => 'cifnif'],
            'contactos.empresa' => ['title' => 'company'],
            'contactos.cargo' => ['title' => 'position'],
            'contactos.telefono1' => ['title' => 'phone'],
            'contactos.telefono2' => ['title' => 'phone2'],
            'contactos.email' => ['title' => 'email'],
            'contactos.direccion' => ['title' => 'address'],
            'contactos.apartado' => ['title' => 'post-office-box'],
            'contactos.codpostal' => ['title' => 'zip-code'],
            'contactos.ciudad' => ['title' => 'city'],
            'contactos.provincia' => ['title' => 'province'],
            'contactos.codpais' => ['title' => 'country'],
            'contactos.personafisica' => ['title' => 'is-person'],
            'contactos.idfuente' => ['title' => 'source'],
            'contactos.admitemarketing' => ['title' => 'allow-marketing'],
            'contactos.observaciones' => ['title' => 'observations'],
            'contactos.codagente' => ['title' => 'agent']
        ];
    }

    protected function getFileType(): string
    {
        return self::METHOD_IMPORT;
    }

    public static function getProfile(): string
    {
        return 'contacts';
    }

    protected function importItem(array $item): bool
    {
        $where = [];
        if (isset($item['contactos.idcontacto']) && !empty($item['contactos.idcontacto'])) {
            $where[] = new DataBaseWhere('idcontacto', $item['contactos.idcontacto']);
        } elseif (isset($item['contactos.nombre']) && !empty($item['contactos.nombre'])) {
            $where[] = new DataBaseWhere('nombre', $item['contactos.nombre']);
        } elseif (isset($item['contactos.cifnif']) && !empty($item['contactos.cifnif'])) {
            $where[] = new DataBaseWhere('cifnif', $item['contactos.cifnif']);
        }

        if (empty($where)) {
            return false;
        }

        $contact = new Contacto();
        if ($contact->loadFromCode('', $where) && $this->model->mode === static::INSERT_MODE
            || false === $contact->loadFromCode('', $where) && $this->model->mode === static::UPDATE_MODE) {
            return false;
        }

        if (false === $this->setModelValues($contact, $item, 'contactos.')) {
            return false;
        }
        return $contact->save();
    }

    protected function setModelValues(ModelClass &$model, array $values, string $prefix): bool
    {
        if (false === parent::setModelValues($model, $values, $prefix)) {
            return false;
        }

        foreach ($model->getModelFields() as $key => $field) {
            if (!isset($values[$prefix . $key])) {
                continue;
            }

            switch ($field['name']) {
                case 'admitemarketing':
                    $model->admitemarketing = false;
                    $am = strtolower($values[$prefix . 'admitemarketing']);
                    $array = ['s', 'si', 'yes', 'y', 'true', '1'];
                    if (in_array($am, $array)) {
                        $model->admitemarketing = true;
                    }
                    break;

                case 'codagente':
                    foreach (Agentes::all() as $agent) {
                        if (strtolower($agent->codagente) === strtolower($values[$prefix . $key])
                            || strtolower($agent->nombre) === strtolower($values[$prefix . $key])) {
                            $model->{$key} = $agent->codagente;
                            break 2;
                        }
                    }
                    $model->{$key} = null;
                    break;

                case 'codpais':
                    foreach (Paises::all() as $country) {
                        if (strtolower($country->codpais) === strtolower($values[$prefix . $key])
                            || strtolower($country->nombre) === strtolower($values[$prefix . $key])
                            || strtolower($country->codiso) === strtolower($values[$prefix . $key])) {
                            $model->{$key} = $country->codpais;
                            break 2;
                        }
                    }

                    // creamos el país
                    $country = new Pais();
                    $country->codpais = $this->formatString($values[$prefix . $key], 3);
                    $country->nombre = $values[$prefix . $key];
                    if (false === $country->save()) {
                        return false;
                    }

                    $model->{$key} = $country->codpais;
                    break;

                case 'idfuente':
                    $modelClass = '\\FacturaScripts\\Dinamic\\Model\\CrmFuente';
                    if (false === class_exists($modelClass)) {
                        break;
                    }
                    $source = new $modelClass();
                    $where = [new DataBaseWhere('nombre', strtolower($values[$prefix . 'idfuente']))];
                    if (false === $source->loadFromCode('', $where)) {
                        // creamos la fuente
                        $source->nombre = $values[$prefix . 'idfuente'];
                        if (false === $source->save()) {
                            return false;
                        }
                    }
                    $model->idfuente = $source->id;
                    break;

                case 'personafisica':
                    // si personafisica esta vacío lo ponemos a false
                    if (empty($values[$prefix . 'personafisica'])) {
                        $model->personafisica = false;
                    }
                    break;
            }
        }

        // Si no se ha asignado ninguna columna para personafisica y el cifnif empieza por A o B, asignar personafisica = false.
        if (false === isset($values[$prefix . 'personafisica']) && isset($values[$prefix . 'cifnif']) && false !== preg_match('/^(A|B)/', strtoupper($values[$prefix . 'cifnif']))) {
            $model->personafisica = false;
        }

        // Si no se ha asignado ninguna columna para tipoidfiscal y el cifnif empieza por A o B, asignar tipoidfiscal = 'CIF'.
        if (false === isset($values[$prefix . 'tipoidfiscal']) && isset($values[$prefix . 'cifnif']) && false !== preg_match('/^(A|B)/', strtoupper($values[$prefix . 'cifnif']))) {
            $model->tipoidfiscal = 'CIF';
        }

        return true;
    }
}