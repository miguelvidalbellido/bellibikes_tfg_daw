<?php
/**
 * Copyright (C) 2020-2022 Carlos Garcia Gomez <carlos@facturascripts.com>
 */

namespace FacturaScripts\Plugins\CSVimport\Lib\ImportProfile;

use FacturaScripts\Dinamic\Model\Familia;

/**
 * Description of FamiliesProfile
 *
 * @author Carlos Garcia Gomez      <carlos@facturascripts.com>
 * @author Daniel Fernandez Giménez <hola@danielfg.es>
 */
class FamiliesProfile extends ProfileClass
{

    public function getDataFields(): array
    {
        return [
            'codfamilia' => ['title' => 'code'],
            'descripcion' => ['title' => 'description']
        ];
    }

    protected function getFileType(): string
    {
        return self::METHOD_IMPORT;
    }

    public static function getProfile(): string
    {
        return 'families';
    }

    protected function importItem(array $item): bool
    {
        if (!isset($item['codfamilia']) || empty($item['codfamilia'])) {
            $this->toolBox()->i18nLog()->warning('field-required', ['%field%' => 'codfamilia']);
            return false;
        }

        $family = new Familia();
        if ($family->loadFromCode($item['codfamilia']) && $this->model->mode === static::INSERT_MODE
            || false === $family->loadFromCode($item['codfamilia']) && $this->model->mode === static::UPDATE_MODE) {
            return false;
        }

        $this->setModelValues($family, $item, '');
        return $family->save();
    }
}
