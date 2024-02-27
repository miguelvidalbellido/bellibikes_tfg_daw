<?php
/**
 * Copyright (C) 2020-2023 Carlos Garcia Gomez <carlos@facturascripts.com>
 */

namespace FacturaScripts\Plugins\CSVimport\Lib\ImportProfile;

use FacturaScripts\Core\Base\DataBase\DataBaseWhere;
use FacturaScripts\Core\Base\ToolBox;
use FacturaScripts\Core\Model\Base\ModelClass;
use FacturaScripts\Core\Plugins;
use FacturaScripts\Dinamic\Model\Almacen;
use FacturaScripts\Dinamic\Model\Atributo;
use FacturaScripts\Dinamic\Model\AtributoValor;
use FacturaScripts\Dinamic\Model\Fabricante;
use FacturaScripts\Dinamic\Model\Familia;
use FacturaScripts\Dinamic\Model\Impuesto;
use FacturaScripts\Dinamic\Model\Producto;
use FacturaScripts\Dinamic\Model\ProductoProveedor;
use FacturaScripts\Dinamic\Model\Proveedor;
use FacturaScripts\Dinamic\Model\Stock;
use FacturaScripts\Dinamic\Model\Subcuenta;
use FacturaScripts\Dinamic\Model\Tarifa;
use FacturaScripts\Dinamic\Model\Variante;

/**
 * Description of ProductsProfile
 *
 * @author Carlos Garcia Gomez      <carlos@facturascripts.com>
 * @author Daniel Fernandez Giménez <hola@danielfg.es>
 */
class ProductsProfile extends ProfileClass
{
    /**
     * @var Familia[]
     */
    protected $families = [];

    /**
     * @var Fabricante[]
     */
    protected $manufacturers = [];

    public function getDataFields(): array
    {
        $fields = [
            'productos.referencia' => ['title' => 'reference'],
            'productos.descripcion' => ['title' => 'description'],
            'productos.observaciones' => ['title' => 'observations'],
            'productos.codfabricante' => ['title' => 'manufacturer'],
            'productos.codfamilia' => ['title' => 'family'],
            'productos.codimpuesto' => ['title' => 'tax-code'],
            'productos.pctimpuesto' => ['title' => 'pct-vat'],
            'productos.codsubcuentacom' => ['title' => 'subaccount-purchases'],
            'productos.codsubcuentaven' => ['title' => 'subaccount-sales'],
            'variantes.codbarras' => ['title' => 'barcode'],
            'variantes.precio' => ['title' => 'price'],
            'variantes.precioconiva' => ['title' => 'price-with-tax'],
            'variantes.coste' => ['title' => 'cost-price'],
            'variantes.margen' => ['title' => 'margin'],
            'stocks.cantidad' => ['title' => 'stock'],
            'stocks.codalmacen' => ['title' => 'warehouse'],
            'productosprov.codproveedor' => ['title' => 'supplier'],
            'productosprov.preciocompra' => ['title' => 'purchase-price'],
            'productosprov.dtopor' => ['title' => 'purchase-discount']
        ];

        if (Plugins::enable('TarifasAvanzadas')) {
            $tarifaModel = new Tarifa();
            foreach ($tarifaModel->all([], [], 0, 0) as $tarifa) {
                $fields['articulostarifas.precio|' . $tarifa->codtarifa] = ['title' => $tarifa->nombre . ' - ' . ToolBox::i18n()->trans('price')];
                $fields['articulostarifas.precioconiva|' . $tarifa->codtarifa] = ['title' => $tarifa->nombre . ' - ' . ToolBox::i18n()->trans('price-with-tax')];
            }
        }

        return $fields;
    }

    public static function getProfile(): string
    {
        return 'products';
    }

    /**
     * @param string $code
     * @param int $len
     *
     * @return string
     */
    protected function cleanCode($code, $len): string
    {
        $table = [
            'Š' => 'S', 'š' => 's', 'Đ' => 'Dj', 'đ' => 'dj', 'Ž' => 'Z', 'ž' => 'z', 'Č' => 'C', 'č' => 'c', 'Ć' => 'C', 'ć' => 'c',
            'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E',
            'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O',
            'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss',
            'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e',
            'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o',
            'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'þ' => 'b',
            'ÿ' => 'y', 'Ŕ' => 'R', 'ŕ' => 'r',
        ];
        $text = preg_replace('/[^a-z0-9\-_]/i', '', strtr($code, $table));
        return strlen($text) > $len ? substr($text, 0, $len) : $text;
    }

    /**
     * @param string $codfamilia
     *
     * @return bool
     */
    protected function findFamily(&$codfamilia): bool
    {
        if (empty($codfamilia)) {
            return false;
        }

        // find in cache
        $newDescripcion = $this->toolBox()->utils()->noHtml($codfamilia);
        $newCodfamilia = $this->cleanCode($newDescripcion, 8);
        foreach ($this->families as $fam) {
            if ($fam->codfamilia == $newCodfamilia || $fam->descripcion == $newDescripcion) {
                $codfamilia = $fam->codfamilia;
                return true;
            }
        }

        // find in database
        $family = new Familia();
        $where = [
            new DataBaseWhere('codfamilia', $newCodfamilia, '=', 'OR'),
            new DataBaseWhere('descripcion', $newDescripcion, '=', 'OR')
        ];
        if ($family->loadFromCode('', $where)) {
            $codfamilia = $family->codfamilia;
            $this->families[$codfamilia] = $family;
            return true;
        }

        // create family
        $family->codfamilia = $newCodfamilia;
        $family->descripcion = $newDescripcion;
        if ($family->save()) {
            $codfamilia = $family->codfamilia;
            $this->families[$codfamilia] = $family;
            return true;
        }

        return false;
    }

    /**
     * @param string $codfabricante
     *
     * @return bool
     */
    protected function findManufacturer(&$codfabricante): bool
    {
        if (empty($codfabricante)) {
            return false;
        }

        // find in cache
        $newNombre = $this->toolBox()->utils()->noHtml($codfabricante);
        $newCodfabricante = $this->cleanCode($codfabricante, 8);
        foreach ($this->manufacturers as $man) {
            if ($man->codfabricante == $newCodfabricante || $man->nombre == $newNombre) {
                $codfabricante = $man->codfabricante;
                return true;
            }
        }

        // find in database
        $manufacturer = new Fabricante();
        $where = [
            new DataBaseWhere('codfabricante', $newCodfabricante, '=', 'OR'),
            new DataBaseWhere('nombre', $newNombre, '=', 'OR')
        ];
        if ($manufacturer->loadFromCode('', $where)) {
            $codfabricante = $manufacturer->codfabricante;
            $this->manufacturers[$codfabricante] = $manufacturer;
            return true;
        }

        // create manufacturer
        $manufacturer->codfabricante = $newCodfabricante;
        $manufacturer->nombre = $newNombre;
        if ($manufacturer->save()) {
            $codfabricante = $manufacturer->codfabricante;
            $this->manufacturers[$codfabricante] = $manufacturer;
            return true;
        }

        return false;
    }

    protected function getIdAtributo($attName, $attValue)
    {
        $atributo = new Atributo();
        if (false === $atributo->loadFromCode($attName)) {
            $atributo->codatributo = $attName;
            $atributo->nombre = $attName;
            $atributo->save();
        }

        $atValor = new AtributoValor();
        $where = [
            new DataBaseWhere('codatributo', $attName),
            new DataBaseWhere('valor', $attValue)
        ];
        if (false === $atValor->loadFromCode('', $where)) {
            $atValor->codatributo = $attName;
            $atValor->valor = $attValue;
            $atValor->save();
        }

        return $atValor->primaryColumnValue();
    }

    protected function getNewReference($prefix): string
    {
        $variant = new Variante();
        for ($num = 1; $num < 100; $num++) {
            $ref = $prefix . $num;
            $where = [new DataBaseWhere('referencia', $ref)];
            if (false === $variant->loadFromCode('', $where)) {
                return $ref;
            }
        }

        return $prefix . mt_rand(101, 9999);
    }

    protected function getFileType(): string
    {
        if (false === stripos($this->model->template, 'factusol')) {
            return self::METHOD_IMPORT;
        }

        if ($this->csv->titles[0] === 'Código' && $this->csv->titles[1] === 'Descripción' && $this->csv->titles[5] === 'Venta') {
            return 'importItemFactusol';
        }

        return self::METHOD_IMPORT;
    }

    protected function importItem(array $item): bool
    {
        $where = [];
        if (isset($item['productos.referencia']) && !empty($item['productos.referencia'])) {
            $where[] = new DataBaseWhere('referencia', $item['productos.referencia']);
        } elseif (isset($item['productos.descripcion']) && !empty($item['productos.descripcion'])) {
            $where[] = new DataBaseWhere('descripcion', $item['productos.descripcion']);
        }
        if (empty($where)) {
            return false;
        }

        $product = new Producto();
        if ($product->loadFromCode('', $where) && $this->model->mode === static::INSERT_MODE
            || false === $product->loadFromCode('', $where) && $this->model->mode === static::UPDATE_MODE) {
            return false;
        }

        if (false === $this->setModelValues($product, $item, 'productos.')) {
            return false;
        }

        // empty reference?
        if (empty($product->referencia)) {
            $product->referencia = $product->newCode('referencia');
        }

        if (false === $this->findFamily($product->codfamilia)) {
            $product->codfamilia = null;
        }

        if (false === $this->findManufacturer($product->codfabricante)) {
            $product->codfabricante = null;
        }

        $this->setImpuesto($product, $item);
        if ($product->save()) {
            $this->importVariant($product, $item);
            $this->importTarifas($product->referencia, $item);
            return true;
        }

        return false;
    }

    protected function importItemFactusol(&$numLines, &$numSave)
    {
        $lastID = 0;
        $utils = static::toolBox()->utils();
        foreach ($this->csv->data as $row) {
            $numLines++;
            /// Is this a variant?
            if (!empty($lastID) && empty($row['Código']) && empty($row['Descripción']) && !empty($row['Referencia'])) {
                $this->saveFactusolVariant($lastID, $row);
                continue;
            }

            $product = new Producto();
            $ref = empty($row['Referencia']) ? $row['Código'] : $row['Referencia'];
            $where = [new DataBaseWhere('referencia', $utils->noHtml($ref))];
            if (empty($ref)
                || $product->loadFromCode('', $where) && $this->model->mode === static::INSERT_MODE
                || false === $product->loadFromCode('', $where) && $this->model->mode === static::UPDATE_MODE) {
                /// product found
                continue;
            }

            $product->descripcion = $row['Descripción'];
            $product->referencia = $ref;
            if (false === $product->save()) {
                continue;
            }

            $numSave++;
            $lastID = $product->primaryColumnValue();
            foreach ($product->getVariants() as $variant) {
                if ($variant->referencia === $product->referencia) {
                    $variant->precio = $this->getFloat($row['Venta']);
                    $variant->coste = $this->getFloat($row['Costo']);
                    $variant->save();
                    break;
                }
            }

            $this->setStock($product, static::getFloat($row['Stock()']));
        }
    }

    protected function importProveedor(Variante $variant, array $item): bool
    {
        if (empty($item['productosprov.codproveedor'] ?? '')) {
            return true;
        }

        // buscar si existe el proveedor
        $proveedor = new Proveedor();
        if (false === $proveedor->loadFromCode($item['productosprov.codproveedor'])) {
            return true;
        }

        // buscar si existe el producto en el proveedor
        $productoProv = new ProductoProveedor();
        $where = [
            new DataBaseWhere('codproveedor', $item['productosprov.codproveedor']),
            new DataBaseWhere('referencia', $variant->referencia)
        ];
        if (false === $productoProv->loadFromCode('', $where)) {
            // si no existe, lo creamos
            $productoProv->codproveedor = $proveedor->codproveedor;
            $productoProv->coddivisa = $this->toolBox()->appSettings()->get('default', 'coddivisa');
            $productoProv->idproducto = $variant->idproducto;
            $productoProv->referencia = $variant->referencia;
        }

        if (isset($item['productosprov.dtopor']) && $item['productosprov.dtopor']) {
            $productoProv->dtopor = $this->getFloat($item['productosprov.dtopor']);
        }

        if (isset($item['productosprov.preciocompra']) && $item['productosprov.preciocompra']) {
            $productoProv->precio = $this->getFloat($item['productosprov.preciocompra']);
        } else {
            $productoProv->precio = empty($variant->coste) ? $variant->precio : $variant->coste;
        }

        $productoProv->neto = $productoProv->precio;
        return $productoProv->save();
    }

    protected function importStock(Variante $variant, array $item): bool
    {
        // si el stock no es numérico, no hacemos nada
        if (false === is_numeric($item['stocks.cantidad'] ?? '')) {
            return true;
        }

        // si tenemos un almacén, lo buscamos, si no usamos el predeterminado
        $codalmacen = $this->toolBox()->appSettings()->get('default', 'codalmacen');
        if (isset($item['stocks.codalmacen']) && $item['stocks.codalmacen']) {

            // si no encontramos el almacén, no hacemos nada
            $warehouse = new Almacen();
            if (false === $warehouse->loadFromCode($item['stocks.codalmacen'])) {
                return true;
            }

            $codalmacen = $warehouse->codalmacen;
        }

        // buscamos el stock
        $stock = new Stock();
        $where = [
            new DataBaseWhere('codalmacen', $codalmacen),
            new DataBaseWhere('referencia', $variant->referencia)
        ];
        if (false === $stock->loadFromCode('', $where)) {
            // si no lo encontramos, lo creamos
            $stock->codalmacen = $codalmacen;
            $stock->idproducto = $variant->getProducto()->idproducto;
            $stock->referencia = $variant->referencia;
        }
        return $this->setModelValues($stock, $item, 'stocks.') && $stock->save();
    }

    protected function importTarifas(string $referencia, array $item)
    {
        if (false === Plugins::enable('TarifasAvanzadas')) {
            return;
        }

        $prefix = 'articulostarifas.';

        // buscamos si en el array item existe algún campo que su key empiece por el prefijo
        $tarifas = array_filter($item, function ($key) use ($prefix) {
            return strpos($key, $prefix) === 0;
        }, ARRAY_FILTER_USE_KEY);

        // recorremos las tarifas del item
        foreach ($tarifas as $key => $value) {
            // si el valor está vacío continuamos
            if ($value == '') {
                continue;
            }

            // eliminamos de la key el prefijo
            $key = str_replace($prefix, '', $key);

            // obtenemos el nombre de la columna y el codtarifa
            list($column, $codtarifa) = explode('|', $key);

            // comprobamos que existe la tarifa
            $tarifaModel = new Tarifa();
            if (false === $tarifaModel->loadFromCode($codtarifa)) {
                continue;
            }

            // buscamos si existe la tarifa en el producto
            $tarifaProducto = new \FacturaScripts\Plugins\TarifasAvanzadas\Model\TarifaProducto();
            $where = [
                new DataBaseWhere('codtarifa', $codtarifa),
                new DataBaseWhere('referencia', $referencia)
            ];
            if (false === $tarifaProducto->loadFromCode('', $where)) {
                // si no existe, la creamos
                $tarifaProducto->codtarifa = $codtarifa;
                $tarifaProducto->referencia = $referencia;
            }

            switch ($column) {
                case 'precio':
                    $tarifaProducto->pvp = $this->getFloat($value);
                    break;
                case 'precioconiva':
                    $tarifaProducto->setPriceWithTax($this->getFloat($value));
                    break;
            }

            $tarifaProducto->save();
        }
    }

    protected function importVariant(Producto $product, array $item): bool
    {
        foreach ($product->getVariants() as $variant) {
            if ($variant->referencia != $product->referencia) {
                continue;
            }

            if (false === $this->setModelValues($variant, $item, 'variantes.')) {
                return false;
            }
            $this->setPrice($product, $variant, $item);
            if (false === $variant->save()) {
                return false;
            }

            return $this->importStock($variant, $item) && $this->importProveedor($variant, $item);
        }

        return false;
    }

    protected function saveFactusolVariant($idproduct, $line)
    {
        if ($line['Referencia'] == 'Talla' && $line['Prov.'] == 'Color') {
            return;
        }

        $product = new Producto();
        if (false === $product->loadFromCode($idproduct)) {
            return;
        }

        $variant = new Variante();
        $variant->coste = $this->getFloat($line['Costo']);
        $variant->idatributovalor1 = $this->getIdAtributo('Talla', $line['Referencia']);
        $variant->idatributovalor2 = $this->getIdAtributo('Color', $line['Prov.']);
        $variant->idproducto = $idproduct;
        $variant->precio = $this->getFloat($line['Venta']);
        $variant->referencia = $this->getNewReference($product->referencia . '-');
        $variant->stockfis = $this->getFloat($line['Stock()']);
        $variant->save();
    }

    protected function setImpuesto(&$product, $item)
    {
        if (false === isset($item['productos.pctimpuesto']) || empty($item['productos.pctimpuesto'])) {
            return;
        }

        // buscamos si existe el % del impuesto
        $impuesto = new Impuesto();
        $where = [
            new DataBaseWhere('iva', $item['productos.pctimpuesto']),
            new DataBaseWhere('tipo', 1)
        ];
        if ($impuesto->loadFromCode('', $where)) {
            $product->codimpuesto = $impuesto->codimpuesto;
        }
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
                case 'codsubcuentacom':
                case 'codsubcuentaven':
                    $subaccount = new Subcuenta();
                    $where = [
                        new DataBaseWhere('codsubcuenta', $values[$prefix . $key]),
                        new DataBaseWhere('codejercicio', date('Y'))
                    ];
                    if ($subaccount->loadFromCode('', $where)) {
                        $model->{$key} = $subaccount->codsubcuenta;
                    }
                    break;
            }
        }
        return true;
    }

    protected function setPrice(Producto $product, Variante &$variant, array $item): void
    {
        if (isset($item['variantes.precioconiva']) && $item['variantes.precioconiva']) {
            $pvp = (100 * static::getFloat($item['variantes.precioconiva'])) / (100 + $product->getTax()->iva);
            $variant->precio = $pvp;
        }
    }

    protected function setStock(Producto $product, float $cantidad)
    {
        $stock = new Stock();
        $codalmacen = static::toolBox()->appSettings()->get('default', 'codalmacen');
        $where = [
            new DataBaseWhere('codalmacen', $codalmacen),
            new DataBaseWhere('referencia', $product->referencia)
        ];
        if (false === $stock->loadFromCode('', $where)) {
            $stock->codalmacen = $codalmacen;
            $stock->idproducto = $product->idproducto;
            $stock->referencia = $product->referencia;
        }
        $stock->cantidad = $cantidad;
        $stock->save();
    }
}
