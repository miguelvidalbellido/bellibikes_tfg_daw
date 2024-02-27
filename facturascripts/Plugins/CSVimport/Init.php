<?php
/**
 * Copyright (C) 2019-2023 Carlos Garcia Gomez <carlos@facturascripts.com>
 */

namespace FacturaScripts\Plugins\CSVimport;

use FacturaScripts\Core\Base\InitClass;

/**
 * Composer autoload.
 */
require_once __DIR__ . '/vendor/autoload.php';

/**
 * Description of Init
 *
 * @author Carlos Garcia Gomez <carlos@facturascripts.com>
 */
final class Init extends InitClass
{
    public function init()
    {
        $this->loadExtension(new Extension\Controller\ListAlbaranCliente());
        $this->loadExtension(new Extension\Controller\ListAtributo());
        $this->loadExtension(new Extension\Controller\ListAttachedFile());
        $this->loadExtension(new Extension\Controller\ListCliente());
        $this->loadExtension(new Extension\Controller\ListContacto());
        $this->loadExtension(new Extension\Controller\ListFabricante());
        $this->loadExtension(new Extension\Controller\ListFacturaCliente());
        $this->loadExtension(new Extension\Controller\ListFacturaProveedor());
        $this->loadExtension(new Extension\Controller\ListFamilia());
        $this->loadExtension(new Extension\Controller\ListProducto());
        $this->loadExtension(new Extension\Controller\ListProveedor());
        $this->loadExtension(new Extension\Controller\ListAsiento());
    }

    public function update()
    {
    }
}
