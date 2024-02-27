<?php
/**
 * Copyright (C) 2020-2022 Carlos Garcia Gomez <carlos@facturascripts.com>
 */

namespace FacturaScripts\Plugins\CSVimport\Extension\Controller;

use Closure;

/**
 * Description of ListAttachedFile
 *
 * @author Carlos Garcia Gomez <carlos@facturascripts.com>
 */
class ListAttachedFile
{
    public function createViews(): Closure
    {
        return function () {
            $viewName = 'ListCSVfile';
            $this->addView($viewName, 'CSVfile', 'csv', 'fas fa-file-csv');
            $this->views[$viewName]->searchFields[] = 'name';
            $this->views[$viewName]->addOrderBy(['date', 'id'], 'date', 2);
            $this->views[$viewName]->addOrderBy(['size'], 'size');
        };
    }
}
