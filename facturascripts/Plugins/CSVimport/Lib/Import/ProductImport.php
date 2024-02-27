<?php
/**
 * Copyright (C) 2019-2021 Carlos Garcia Gomez <carlos@facturascripts.com>
 */

namespace FacturaScripts\Plugins\CSVimport\Lib\Import;

use FacturaScripts\Core\Base\DataBase\DataBaseWhere;
use FacturaScripts\Dinamic\Model\Atributo;
use FacturaScripts\Dinamic\Model\AtributoValor;
use FacturaScripts\Dinamic\Model\Fabricante;
use FacturaScripts\Dinamic\Model\Familia;
use FacturaScripts\Dinamic\Model\Impuesto;
use FacturaScripts\Dinamic\Model\Producto;
use FacturaScripts\Dinamic\Model\Stock;
use FacturaScripts\Dinamic\Model\Variante;

/**
 * Description of ProductImport
 *
 * @author Carlos Garcia Gomez <carlos@facturascripts.com>
 */
class ProductImport extends CsvImporClass
{

    /**
     *
     * @var Familia[]
     */
    protected static $families = [];

    /**
     *
     * @var Fabricante[]
     */
    protected static $manufacturers = [];

    /**
     *
     * @param string $codfamilia
     *
     * @return bool
     */
    protected static function findFamily($codfamilia): bool
    {
        if (empty($codfamilia)) {
            return false;
        }

        /// find in cache
        foreach (static::$families as $fam) {
            if ($fam->codfamilia === $codfamilia) {
                return true;
            }
        }

        /// find in database
        $family = new Familia();
        if ($family->loadFromCode($codfamilia)) {
            static::$families[$codfamilia] = $family;
            return true;
        }

        return false;
    }

    /**
     *
     * @param string $codfabricante
     *
     * @return bool
     */
    protected static function findManufacturer($codfabricante): bool
    {
        if (empty($codfabricante)) {
            return false;
        }

        /// find in cache
        foreach (static::$manufacturers as $man) {
            if ($man->codfabricante == $codfabricante) {
                return true;
            }
        }

        /// find in database
        $manufacturer = new Fabricante();
        if ($manufacturer->loadFromCode($codfabricante)) {
            static::$manufacturers[$codfabricante] = $manufacturer;
            return true;
        }

        return false;
    }

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
        } elseif ($csv->titles[0] === 'actualizado' && $csv->titles[1] === 'bloqueado') {
            return static::TYPE_FACTURASCRIPTS;
        } elseif ($csv->titles[0] === 'referencia' && $csv->titles[1] === 'codfamilia') {
            return static::TYPE_FACTURASCRIPTS_2017;
        } elseif ($csv->titles[0] === 'Código' && $csv->titles[1] === 'Descripción') {
            return static::TYPE_FACTUSOL;
        }

        return static::TYPE_NONE;
    }

    /**
     *
     * @param string $attName
     * @param string $attValue
     *
     * @return int
     */
    protected static function getIdatributo($attName, $attValue)
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

    /**
     *
     * @param string $prefix
     *
     * @return string
     */
    protected static function getNewReference($prefix): string
    {
        $variant = new Variante();
        for ($num = 1; $num < 100; $num++) {
            $ref = $prefix . $num;
            $where = [new DataBaseWhere('referencia', $ref)];
            if (false === $variant->loadFromCode('', $where)) {
                return $ref;
            }
        }

        return $prefix . \mt_rand(101, 9999);
    }

    /**
     *
     * @return string
     */
    protected static function getProfile(): string
    {
        return 'products';
    }

    /**
     *
     * @param string $filePath
     * @param string $mode
     * @param int $offset
     *
     * @return array
     */
    protected static function importCSVfactusol(string $filePath, string $mode, int $offset): array
    {
        $csv = static::getCsv($filePath, $offset);

        $numSave = 0;
        $numLines = 0;
        $lastID = 0;
        $utils = static::toolBox()->utils();
        foreach ($csv->data as $row) {
            $numLines++;
            /// Is this a variant?
            if (!empty($lastID) && empty($row['Código']) && empty($row['Descripción']) && !empty($row['Referencia'])) {
                static::saveFactusolVariant($lastID, $row);
                continue;
            }

            $product = new Producto();
            $ref = empty($row['Referencia']) ? $row['Código'] : $row['Referencia'];
            $where = [new DataBaseWhere('referencia', $utils->noHtml($ref))];
            if (empty($ref)
                || $product->loadFromCode('', $where) && $mode === static::INSERT_MODE
                || false === $product->loadFromCode('', $where) && $mode === static::UPDATE_MODE) {
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
                    $variant->precio = static::getFloat($row['Venta']);
                    $variant->coste = static::getFloat($row['Costo']);
                    $variant->save();
                    break;
                }
            }

            static::setStock($product, static::getFloat($row['Stock()']));
        }

        return ['save' => $numSave, 'lines' => $numLines];
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
        $csv = static::getCsv($filePath, $offset);

        $numSave = 0;
        $numLines = 0;
        $utils = static::toolBox()->utils();
        foreach ($csv->data as $row) {
            $numLines++;
            $product = new Producto();
            $where = [new DataBaseWhere('referencia', $utils->noHtml($row['referencia']))];
            if (empty($row['referencia'])
                || $product->loadFromCode('', $where) && $mode === static::INSERT_MODE
                || false === $product->loadFromCode('', $where) && $mode === static::UPDATE_MODE) {
                /// product found
                continue;
            }

            $product->loadFromData($row, ['idproducto']);

            /// check family, manufacturer and tax
            if (false === static::findFamily($product->codfamilia)) {
                $product->codfamilia = null;
            }
            if (false === static::findManufacturer($product->codfabricante)) {
                $product->codfabricante = null;
            }
            if (empty($product->codimpuesto)) {
                $product->codimpuesto = null;
            }
            if (false === $product->save()) {
                continue;
            }

            $numSave++;
            foreach ($product->getVariants() as $variant) {
                if ($variant->referencia === $product->referencia) {
                    $variant->precio = static::getFloat($row['precio']);
                    $variant->save();
                    break;
                }
            }

            static::setStock($product, static::getFloat($row['stockfis']));
        }

        return ['save' => $numSave, 'lines' => $numLines];
    }

    /**
     *
     * @param string $filePath
     * @param string $mode
     * @param int $offset
     *
     * @return array
     */
    protected static function importCSVfs2017(string $filePath, string $mode, int $offset): array
    {
        $csv = static::getCsv($filePath, $offset);

        $taxModel = new Impuesto();
        $taxes = $taxModel->all();

        $numSave = 0;
        $numLines = 0;
        $utils = static::toolBox()->utils();
        foreach ($csv->data as $row) {
            $numLines++;
            $product = new Producto();
            $where = [new DataBaseWhere('referencia', $utils->noHtml($row['referencia']))];
            if (empty($row['referencia'])
                || $product->loadFromCode('', $where) && $mode === static::INSERT_MODE
                || false === $product->loadFromCode('', $where) && $mode === static::UPDATE_MODE) {
                /// product found
                continue;
            }

            $product->loadFromData($row, ['idproducto']);

            /// check family, manufacturer and tax
            if (false === static::findFamily($product->codfamilia)) {
                $product->codfamilia = null;
            }
            if (false === static::findManufacturer($product->codfabricante)) {
                $product->codfabricante = null;
            }
            foreach ($taxes as $tax) {
                if ($utils->floatcmp(static::getFloat($row['iva']), $tax->iva)) {
                    $product->codimpuesto = $tax->codimpuesto;
                    break;
                }
            }
            if (false === $product->save()) {
                continue;
            }

            $numSave++;
            foreach ($product->getVariants() as $variant) {
                if ($variant->referencia === $product->referencia) {
                    $variant->codbarras = $row['codbarras'];
                    $variant->coste = static::getFloat($row['coste']);
                    $variant->precio = static::getFloat($row['pvp']);
                    $variant->save();
                    break;
                }
            }

            static::setStock($product, static::getFloat($row['stockfis']));
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
            case static::TYPE_FACTUSOL:
                return static::importCSVfactusol($filePath, $mode, $offset);

            case static::TYPE_FACTURASCRIPTS:
                return static::importCSVfs($filePath, $mode, $offset);

            case static::TYPE_FACTURASCRIPTS_2017:
                return static::importCSVfs2017($filePath, $mode, $offset);

            default:
                static::toolBox()->i18nLog()->warning('file-not-supported-advanced');
                return ['save' => 0, 'lines' => 0];
        }
    }

    /**
     *
     * @param int   $idproduct
     * @param array $line
     */
    protected static function saveFactusolVariant($idproduct, $line)
    {
        if ($line['Referencia'] == 'Talla' && $line['Prov.'] == 'Color') {
            return;
        }

        $product = new Producto();
        if (false === $product->loadFromCode($idproduct)) {
            return;
        }

        $variant = new Variante();
        $variant->coste = static::getFloat($line['Costo']);
        $variant->idatributovalor1 = static::getIdatributo('Talla', $line['Referencia']);
        $variant->idatributovalor2 = static::getIdatributo('Color', $line['Prov.']);
        $variant->idproducto = $idproduct;
        $variant->precio = static::getFloat($line['Venta']);
        $variant->referencia = static::getNewReference($product->referencia . '-');
        $variant->stockfis = static::getFloat($line['Stock()']);
        $variant->save();
    }

    /**
     * @param Producto $product
     * @param float    $cantidad
     */
    protected static function setStock(Producto $product, float $cantidad)
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
