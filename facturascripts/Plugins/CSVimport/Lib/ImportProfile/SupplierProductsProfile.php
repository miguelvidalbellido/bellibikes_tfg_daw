<?php
/**
 * Copyright (C) 2020-2022 Carlos Garcia Gomez <carlos@facturascripts.com>
 */

namespace FacturaScripts\Plugins\CSVimport\Lib\ImportProfile;

use FacturaScripts\Core\Base\DataBase\DataBaseWhere;
use FacturaScripts\Dinamic\Model\ProductoProveedor;
use FacturaScripts\Dinamic\Model\Proveedor;

/**
 * Description of SupplierProductsProfile
 *
 * @author Carlos Garcia Gomez <carlos@facturascripts.com>
 * @author Daniel Fernandez Giménez <hola@danielfg.es>
 */
class SupplierProductsProfile extends ProfileClass
{

    /**
     * @var array
     */
    private $suppliersFound = [];

    /**
     * @var array
     */
    private $suppliersNotFound = [];

    public function getDataFields(): array
    {
        return [
            'productosprov.codproveedor' => ['title' => 'supplier-code'],
            'productosprov.referencia' => ['title' => 'reference'],
            'productosprov.refproveedor' => ['title' => 'supplier-reference'],
            'productosprov.precio' => ['title' => 'price'],
            'productosprov.dtopor' => ['title' => 'purchase-discount']
        ];
    }

    protected function getFileType(): string
    {
        return self::METHOD_IMPORT;
    }

    public static function getProfile(): string
    {
        return 'supplier-products';
    }

    protected function importItem(array $item): bool
    {
        if (!isset($item['productosprov.codproveedor']) || !isset($item['productosprov.referencia'])) {
            return false;
        } elseif (empty($item['productosprov.codproveedor']) || empty($item['productosprov.referencia'])) {
            return false;
        }

        if (false === $this->supplierExists($item['productosprov.codproveedor'])) {
            $this->toolBox()->log()->error('supplier-not-found: ' . $item['productosprov.codproveedor']);
            return false;
        }

        $product = new ProductoProveedor();
        $where = [
            new DataBaseWhere('codproveedor', $item['productosprov.codproveedor']),
            new DataBaseWhere('referencia', $item['productosprov.referencia'])
        ];
        if ($product->loadFromCode('', $where) && $this->model->mode === static::INSERT_MODE
            || false === $product->loadFromCode('', $where) && $this->model->mode === static::UPDATE_MODE) {
            return false;
        }

        if (false === $this->setModelValues($product, $item, 'productosprov.')) {
            return false;
        }
        return $product->save();
    }

    /**
     * @param string $code
     *
     * @return bool
     */
    private function supplierExists($code): bool
    {
        if (in_array($code, $this->suppliersFound, true)) {
            return true;
        } elseif (in_array($code, $this->suppliersNotFound, true)) {
            return false;
        }

        $supplier = new Proveedor();
        if ($supplier->loadFromCode($code)) {
            $this->suppliersFound[] = $code;
            return true;
        }

        $this->suppliersNotFound[] = $code;
        return false;
    }
}
