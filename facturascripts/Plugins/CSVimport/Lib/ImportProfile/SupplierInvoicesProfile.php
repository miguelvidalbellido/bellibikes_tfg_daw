<?php
/**
 * Copyright (C) 2020-2023 Carlos Garcia Gomez <carlos@facturascripts.com>
 */

namespace FacturaScripts\Plugins\CSVimport\Lib\ImportProfile;

use FacturaScripts\Core\Base\Calculator;
use FacturaScripts\Core\Base\DataBase\DataBaseWhere;
use FacturaScripts\Core\DataSrc\Impuestos;
use FacturaScripts\Core\Model\Base\BusinessDocumentLine;
use FacturaScripts\Core\Model\Base\ModelClass;
use FacturaScripts\Dinamic\Lib\BusinessDocumentCode;
use FacturaScripts\Dinamic\Model\Divisa;
use FacturaScripts\Dinamic\Model\FacturaProveedor;
use FacturaScripts\Dinamic\Model\Proveedor;
use FacturaScripts\Dinamic\Model\Serie;

/**
 * Description of SupplierInvoicesProfile
 *
 * @author Carlos Garcia Gomez      <carlos@facturascripts.com>
 * @author Daniel Fernandez Giménez <hola@danielfg.es>
 */
class SupplierInvoicesProfile extends ProfileClass
{
    /** @var array */
    private $processingInvoices = [];

    public function getDataFields(): array
    {
        return [
            'facturasprov.codigo' => ['title' => 'invoice-code'],
            'facturasprov.numero' => ['title' => 'invoice-number'],
            'facturasprov.numproveedor' => ['title' => 'numsupplier'],
            'facturasprov.fecha' => ['title' => 'date'],
            'facturasprov.hora' => ['title' => 'hour'],
            'facturasprov.codserie' => ['title' => 'serie'],
            'facturasprov.coddivisa' => ['title' => 'currency'],
            'facturasprov.dtopor1' => ['title' => 'invoice-dtopor1'],
            'facturasprov.dtopor2' => ['title' => 'invoice-dtopor2'],
            'facturasprov.neto' => ['title' => 'invoice-net'],
            'facturasprov.totaliva' => ['title' => 'invoice-iva'],
            'facturasprov.totalrecargo' => ['title' => 'invoice-surcharge'],
            'facturasprov.total' => ['title' => 'invoice-total'],
            'facturasprov.observaciones' => ['title' => 'observations'],
            'facturasprov.nombreproveedor' => ['title' => 'supplier-name'],
            'facturasprov.cifnif' => ['title' => 'cifnif'],
            'proveedores.codproveedor' => ['title' => 'supplier-code'],
            'proveedores.email' => ['title' => 'email'],
            'proveedores.telefono1' => ['title' => 'phone'],
            'lineasfacturasprov.referencia' => ['title' => 'line-reference'],
            'lineasfacturasprov.descripcion' => ['title' => 'line-description'],
            'lineasfacturasprov.cantidad' => ['title' => 'line-quantity'],
            'lineasfacturasprov.pvpunitario' => ['title' => 'line-price'],
            'lineasfacturasprov.dtopor' => ['title' => 'line-dto'],
            'lineasfacturasprov.dtopor2' => ['title' => 'line-dto-2'],
            'lineasfacturasprov.iva' => ['title' => 'line-iva'],
            'lineasfacturasprov.recargo' => ['title' => 'line-surcharge'],
            'lineasfacturasprov.irpf' => ['title' => 'line-irpf'],
            'lineasfacturasprov.suplido' => ['title' => 'line-supplied']
        ];
    }

    protected function getFileType(): string
    {
        return self::METHOD_IMPORT;
    }

    public static function getProfile(): string
    {
        return 'supplier-invoices';
    }

    protected function findInvoice(array $item): ?FacturaProveedor
    {
        $where = [];
        if (isset($item['facturasprov.codigo']) && !empty($item['facturasprov.codigo'])) {
            // si hay código, buscamos por código
            $where[] = new DataBaseWhere('codigo', $item['facturasprov.codigo']);
        } elseif (isset($item['facturasprov.numero']) && !empty($item['facturasprov.numero'])) {
            // si hay número, buscamos por número y serie
            $where[] = new DataBaseWhere('numero', $item['facturasprov.numero']);
            if (isset($item['facturasprov.codserie']) && !empty($item['facturasprov.codserie'])) {
                $where[] = new DataBaseWhere('codserie', $this->formatSerie($item['facturasprov.codserie']));
            } else {
                // si no hay serie, usamos la predeterminada
                $where[] = new DataBaseWhere('codserie', $this->toolBox()->appSettings()->get('default', 'codserie'));
            }
            // si hay fecha, la usamos para filtrar mejor (dos facturas pueden tener mismo número y serie pero diferente fecha)
            if (isset($item['facturasprov.fecha']) && !empty($item['facturasprov.fecha'])) {
                $where[] = new DataBaseWhere('fecha', $this->getDate($item['facturasprov.fecha']));
            }
        }
        if (empty($where)) {
            $this->toolBox()->i18nLog()->warning('invoice-code-or-number-missing');
            return null;
        }

        // buscamos la factura en la base de datos
        $invoice = new FacturaProveedor();
        if (false === $invoice->loadFromCode('', $where)) {
            // no la hemos encontrado, devolvemos la factura vacía
            return $invoice;
        }

        // hemos encontrado la factura, comprobamos si ya la estábamos procesando
        if (in_array($invoice->idfactura, $this->processingInvoices)) {
            // la estábamos procesando, así que podemos modificarla, la devolvemos
            return $invoice;
        }

        // la factura ya estaba en la base de datos, pero no la estábamos procesando, así que no podemos modificarla
        $this->toolBox()->i18nLog()->warning('invoice-already-exists', ['%invoice%' => $invoice->codigo]);
        return null;
    }

    protected function findSupplier(FacturaProveedor &$invoice, array $item): bool
    {
        $where = [];
        if (isset($item['proveedores.codproveedor']) && !empty($item['proveedores.codproveedor'])) {
            $where[] = new DataBaseWhere('codproveedor', $item['proveedores.codproveedor']);
        } elseif (isset($item['facturasprov.cifnif']) && !empty($item['facturasprov.cifnif'])) {
            $where[] = new DataBaseWhere('cifnif', $item['facturasprov.cifnif']);
        } elseif (isset($item['proveedores.email']) && !empty($item['proveedores.email'])) {
            $where[] = new DataBaseWhere('email', $item['proveedores.email']);
        } elseif (isset($item['facturasprov.nombreproveedor']) && !empty($item['facturasprov.nombreproveedor'])) {
            $where[] = new DataBaseWhere('nombre', $item['facturasprov.nombreproveedor']);
        }
        if (empty($where)) {
            // falta el código de proveedor, cifnif, email o nombre
            $this->toolBox()->i18nLog()->warning('missing-supplier-data');
            return false;
        }

        $supplier = new Proveedor();
        if (false === $supplier->loadFromCode('', $where)) {
            $supplier->nombre = $item['facturasprov.nombreproveedor'] ?? null;
            $supplier->codproveedor = $item['proveedores.codproveedor'] ?? null;
            $supplier->cifnif = $item['facturasprov.cifnif'] ?? '';
            $supplier->email = $item['proveedores.email'] ?? '';
            $supplier->telefono1 = $item['proveedores.telefono1'] ?? '';
            if (false === $supplier->save()) {
                $this->toolBox()->log()->error('supplier-save-error: ' . $supplier->nombre);
                return false;
            }
        }

        return $invoice->setSubject($supplier);
    }

    protected function formatSerie($serie): string
    {
        return substr($serie, 0, 4);
    }

    protected function importItem(array $item): bool
    {
        // buscamos la factura
        $invoice = $this->findInvoice($item);
        if (null === $invoice) {
            return false;
        }

        if (false === $invoice->exists()) {
            // buscamos el proveedor
            if (false === $this->findSupplier($invoice, $item)) {
                $this->toolBox()->i18nLog()->warning('supplier-not-found');
                return false;
            }

            // añadimos los datos de la factura
            if (false === $this->setModelValues($invoice, $item, 'facturasprov.')) {
                return false;
            }
            // si no tiene código, generamos el código correspondiente
            if (empty($invoice->codigo)) {
                BusinessDocumentCode::setNewCode($invoice, empty($item['facturasprov.numero']));
            } elseif (empty($item['facturasprov.numero'])) {
                // si no tiene número, lo generamos
                BusinessDocumentCode::setNewNumber($invoice);
            }
            // guardamos la factura
            $lines = [];
            if (false === Calculator::calculate($invoice, $lines, true)) {
                $this->toolBox()->log()->error('invoice-error: ' . $invoice->codigo . ', ' . $invoice->fecha . ' (' . $item['facturascli.fecha'] . ')');
                return false;
            }
        }

        // añadimos la línea a la factura
        if (false === $this->newLine($invoice, $item)) {
            $this->toolBox()->log()->error('invoice-line-error: ' . $invoice->codigo);
            return false;
        }

        // actualizamos los totales de la factura
        $lines = $invoice->getLines();
        if (false === Calculator::calculate($invoice, $lines, true)) {
            $this->toolBox()->log()->error('invoice-calculation-error: ' . $invoice->codigo);
            return false;
        }

        // añadimos a la lista de facturas procesadas
        $this->processingInvoices[] = $invoice->idfactura;
        return true;
    }

    protected function newLine(FacturaProveedor $invoice, array $item): bool
    {
        // si tenemos el neto de la factura, pero no el precio de la línea, entonces creamos una line con el neto
        if (isset($item['facturasprov.neto'], $item['facturasprov.totaliva'], $item['facturasprov.total']) &&
            false === isset($item['lineasfacturasprov.pvpunitario'])) {
            $line = $invoice->getNewLine();
            $line->cantidad = 1;
            $line->descripcion = 'Totales';

            // calculamos en base a los totales
            $neto = isset($item['facturasprov.neto']) ? static::getFloat($item['facturasprov.neto']) : 0.0;
            $totalIva = isset($item['facturasprov.totaliva']) ? static::getFloat($item['facturasprov.totaliva']) : 0.0;
            $iva = empty($neto) ? 0 : $totalIva * 100 / $neto;
            $totalRecargo = isset($item['facturasprov.totalrecargo']) ? static::getFloat($item['facturasprov.totalrecargo']) : 0.0;
            $recargo = empty($neto) ? 0 : $totalRecargo * 100 / $neto;
            $this->setLineTax($line, $iva, $recargo);

            $total = isset($item['facturasprov.total']) ? static::getFloat($item['facturasprov.total']) : 0.0;
            $line->pvpunitario = $total - $totalIva - $totalRecargo;
            $line->pvptotal = $total;
            return $line->save();
        }

        // en caso contrario, creamos una línea con los datos que nos han proporcionado
        $referencia = $item['lineasfacturasprov.referencia'] ?? '';
        $line = $invoice->getNewProductLine($referencia);
        $line->descripcion = $item['lineasfacturasprov.descripcion'] ?? $line->descripcion;
        $line->cantidad = isset($item['lineasfacturasprov.cantidad']) ? static::getFloat($item['lineasfacturasprov.cantidad']) : $line->cantidad;
        $line->dtopor = isset($item['lineasfacturasprov.dtopor']) ? static::getFloat($item['lineasfacturasprov.dtopor']) : $line->dtopor;
        $line->dtopor2 = isset($item['lineasfacturasprov.dtopor2']) ? static::getFloat($item['lineasfacturasprov.dtopor2']) : $line->dtopor2;
        $line->pvpunitario = isset($item['lineasfacturasprov.pvpunitario']) ? static::getFloat($item['lineasfacturasprov.pvpunitario']) : $line->pvpunitario;
        $line->irpf = isset($item['lineasfacturasprov.irpf']) ? static::getFloat($item['lineasfacturasprov.irpf']) : $line->irpf;
        $line->suplido = (bool)($item['lineasfacturasprov.suplido'] ?? 0);

        $iva = isset($item['lineasfacturasprov.iva']) ? static::getFloat($item['lineasfacturasprov.iva']) : $line->iva;
        $recargo = isset($item['lineasfacturasprov.recargo']) ? static::getFloat($item['lineasfacturasprov.recargo']) : $line->recargo;
        $this->setLineTax($line, $iva, $recargo);
        return $line->save();
    }

    protected function setLineTax(BusinessDocumentLine &$line, float $iva, float $recargo): void
    {
        $line->codimpuesto = null;
        $line->iva = $iva;
        $line->recargo = $recargo;
        foreach (Impuestos::all() as $impuesto) {
            if ($impuesto->iva == $iva) {
                $line->codimpuesto = $impuesto->codimpuesto;
                break;
            }
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
                case 'coddivisa':
                    $currency = new Divisa();
                    if (false === $currency->loadFromCode($values[$prefix . $key])) {
                        $model->{$key} = null;
                    }
                    break;

                case 'codserie':
                    $codserie = $this->formatSerie($values[$prefix . $key]);

                    // si la serie proporcionada está vacía, usamos la por defecto
                    if (empty($codserie)) {
                        $model->{$key} = $this->toolBox()->appSettings()->get('default', 'codserie');
                        break;
                    }

                    // si la serie existe, la asignamos
                    $serie = new Serie();
                    if ($serie->loadFromCode($codserie)) {
                        $model->{$key} = $serie->codserie;
                        break;
                    }

                    // si la serie no existe, la creamos
                    $serie->codserie = $codserie;
                    $serie->descripcion = $values[$prefix . $key];
                    if (false === $serie->save()) {
                        return false;
                    }

                    $model->{$key} = $serie->codserie;
                    break;

                case 'fecha':
                    if (false === $model->setDate($model->fecha, $model->hora)) {
                        return false;
                    }
                    break;

                case 'numero':
                    if (false === is_numeric($values[$prefix . $key])) {
                        $this->toolBox()->i18nLog()->warning('invalid-invoice-number', ['%number%' => $values[$prefix . $key]]);
                        return false;
                    }
                    break;
            }
        }
        return true;
    }
}
