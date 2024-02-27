<?php
/**
 * Copyright (C) 2020-2023 Carlos Garcia Gomez <carlos@facturascripts.com>
 */

namespace FacturaScripts\Plugins\CSVimport\Lib\ImportProfile;

use FacturaScripts\Core\App\AppSettings;
use FacturaScripts\Core\Base\Calculator;
use FacturaScripts\Core\Base\DataBase\DataBaseWhere;
use FacturaScripts\Core\Base\ToolBox;
use FacturaScripts\Core\DataSrc\Impuestos;
use FacturaScripts\Core\Model\Base\BusinessDocumentLine;
use FacturaScripts\Core\Model\Base\ModelClass;
use FacturaScripts\Dinamic\Lib\BusinessDocumentCode;
use FacturaScripts\Dinamic\Model\AlbaranCliente;
use FacturaScripts\Dinamic\Model\Cliente;
use FacturaScripts\Dinamic\Model\Divisa;
use FacturaScripts\Dinamic\Model\Pais;
use FacturaScripts\Dinamic\Model\Serie;

/**
 * Description of CustomerDeliveryNotesProfile
 *
 * @author Carlos Garcia Gomez      <carlos@facturascripts.com>
 * @author Daniel Fernandez Giménez <hola@danielfg.es>
 */
class CustomerDeliveryNotesProfile extends ProfileClass
{
    /** @var array */
    private $processingDeliveryNotes = [];

    public function getDataFields(): array
    {
        return [
            'albaranescli.codigo' => ['title' => 'invoice-code'],
            'albaranescli.numero' => ['title' => 'invoice-number'],
            'albaranescli.numero2' => ['title' => 'number2'],
            'albaranescli.fecha' => ['title' => 'date'],
            'albaranescli.hora' => ['title' => 'hour'],
            'albaranescli.codserie' => ['title' => 'serie'],
            'albaranescli.coddivisa' => ['title' => 'currency'],
            'albaranescli.dtopor1' => ['title' => 'invoice-dtopor1'],
            'albaranescli.dtopor2' => ['title' => 'invoice-dtopor2'],
            'albaranescli.neto' => ['title' => 'invoice-net'],
            'albaranescli.totaliva' => ['title' => 'invoice-iva'],
            'albaranescli.totalrecargo' => ['title' => 'invoice-surcharge'],
            'albaranescli.total' => ['title' => 'invoice-total'],
            'albaranescli.observaciones' => ['title' => 'observations'],
            'albaranescli.nombrecliente' => ['title' => 'customer-name'],
            'albaranescli.apellidos' => ['title' => 'customer-surname'],
            'albaranescli.cifnif' => ['title' => 'cifnif'],
            'clientes.codcliente' => ['title' => 'customer-code'],
            'clientes.email' => ['title' => 'email'],
            'clientes.telefono1' => ['title' => 'phone'],
            'albaranescli.direccion' => ['title' => 'address'],
            'albaranescli.codpostal' => ['title' => 'zip-code'],
            'albaranescli.apartado' => ['title' => 'post-office-box'],
            'albaranescli.ciudad' => ['title' => 'city'],
            'albaranescli.provincia' => ['title' => 'province'],
            'albaranescli.codpais' => ['title' => 'country'],
            'lineasalbaranescli.referencia' => ['title' => 'line-reference'],
            'lineasalbaranescli.descripcion' => ['title' => 'line-description'],
            'lineasalbaranescli.cantidad' => ['title' => 'line-quantity'],
            'lineasalbaranescli.pvpunitario' => ['title' => 'line-price'],
            'lineasalbaranescli.dtopor' => ['title' => 'line-dto'],
            'lineasalbaranescli.dtopor2' => ['title' => 'line-dto-2'],
            'lineasalbaranescli.iva' => ['title' => 'line-iva'],
            'lineasalbaranescli.recargo' => ['title' => 'line-surcharge'],
            'lineasalbaranescli.irpf' => ['title' => 'line-irpf'],
            'lineasalbaranescli.suplido' => ['title' => 'line-supplied']
        ];
    }

    protected function getFileType(): string
    {
        return self::METHOD_IMPORT;
    }

    public static function getProfile(): string
    {
        return 'customer-delivery-notes';
    }

    protected function findCustomer(AlbaranCliente &$deliveryNote, array $item): bool
    {
        $where = [];
        if (isset($item['clientes.codcliente']) && !empty($item['clientes.codcliente'])) {
            $where[] = new DataBaseWhere('codcliente', $item['clientes.codcliente']);
        } elseif (isset($item['albaranescli.cifnif']) && !empty($item['albaranescli.cifnif'])) {
            $where[] = new DataBaseWhere('cifnif', $item['albaranescli.cifnif']);
        } elseif (isset($item['clientes.email']) && !empty($item['clientes.email'])) {
            $where[] = new DataBaseWhere('email', $item['clientes.email']);
        } elseif (isset($item['albaranescli.nombrecliente']) && !empty($item['albaranescli.nombrecliente'])) {
            $where[] = new DataBaseWhere('nombre', $item['albaranescli.nombrecliente']);
        }
        if (empty($where)) {
            // falta el código de cliente, cifnif, email o nombre
            ToolBox::i18nLog()->warning('missing-customer-data');
            return false;
        }

        $customer = new Cliente();
        if (false === $customer->loadFromCode('', $where)) {
            // creamos el cliente
            $name = $item['albaranescli.nombrecliente'] ?? '';
            $surname = $item['albaranescli.apellidos'] ?? '';
            if (empty($name)) {
                return false;
            }

            $customer->nombre = empty($surname) ? $name : implode(' ', [$name, $surname]);
            $customer->codcliente = $item['clientes.codcliente'] ?? null;
            $customer->cifnif = $item['albaranescli.cifnif'] ?? '';
            $customer->email = $item['clientes.email'] ?? '';
            $customer->telefono1 = $item['clientes.telefono1'] ?? '';
            if (false === $customer->save()) {
                ToolBox::i18nLog()->error('customer-save-error: ' . $customer->nombre);
                return false;
            }
        }

        if (false === $deliveryNote->setSubject($customer)) {
            return false;
        }

        // si hay una columna de dirección, desvinculamos la dirección del cliente en el albarán
        if (isset($item['albaranescli.direccion']) && !empty($item['albaranescli.direccion'])) {
            $deliveryNote->idcontactofact = null;
        }

        return true;
    }

    protected function findDeliveryNote(array $item): ?AlbaranCliente
    {
        $where = [];
        if (isset($item['albaranescli.codigo']) && !empty($item['albaranescli.codigo'])) {
            // si hay código, buscamos por código
            $where[] = new DataBaseWhere('codigo', $item['albaranescli.codigo']);
        } elseif (isset($item['albaranescli.numero']) && !empty($item['albaranescli.numero'])) {
            // si hay número, buscamos por número y serie
            $where[] = new DataBaseWhere('numero', $item['albaranescli.numero']);
            if (isset($item['albaranescli.codserie']) && !empty($item['albaranescli.codserie'])) {
                $where[] = new DataBaseWhere('codserie', $this->formatSerie($item['albaranescli.codserie']));
            } else {
                // si no hay serie, usamos la predeterminada
                $where[] = new DataBaseWhere('codserie', AppSettings::get('default', 'codserie'));
            }
            // si hay fecha, la usamos para filtrar mejor (dos albaranes pueden tener mismo número y serie pero diferente fecha)
            if (isset($item['albaranescli.fecha']) && !empty($item['albaranescli.fecha'])) {
                $where[] = new DataBaseWhere('fecha', $this->getDate($item['albaranescli.fecha']));
            }
        }
        if (empty($where)) {
            ToolBox::i18nLog()->warning('invoice-code-or-number-missing');
            return null;
        }

        // buscamos la albarán en la base de datos
        $deliveryNote = new AlbaranCliente();
        if (false === $deliveryNote->loadFromCode('', $where)) {
            // no la hemos encontrado, devolvemos la albarán vacía
            return $deliveryNote;
        }

        // hemos encontrado el albarán, comprobamos si ya la estábamos procesando
        if (in_array($deliveryNote->idalbaran, $this->processingDeliveryNotes)) {
            // la estábamos procesando, así que podemos modificarla, la devolvemos
            return $deliveryNote;
        }

        // el albarán ya estaba en la base de datos, pero no la estábamos procesando, así que no podemos modificarla
        ToolBox::i18nLog()->warning('invoice-already-exists', ['%invoice%' => $deliveryNote->codigo]);
        return null;
    }

    protected function formatSerie($serie): string
    {
        return substr($serie, 0, 4);
    }

    protected function importItem(array $item): bool
    {
        // buscamos la albarán
        $deliveryNote = $this->findDeliveryNote($item);
        if (null === $deliveryNote) {
            return false;
        }

        // buscamos el cliente
        if (false === $this->findCustomer($deliveryNote, $item)) {
            ToolBox::i18nLog()->warning('customer-not-found');
            return false;
        }

        // añadimos los datos de la albarán
        if (false === $this->setModelValues($deliveryNote, $item, 'albaranescli.')) {
            return false;
        }
        // si no tiene código, generamos el código correspondiente
        if (empty($deliveryNote->codigo)) {
            BusinessDocumentCode::setNewCode($deliveryNote, empty($item['albaranescli.numero']));
        } elseif (empty($item['albaranescli.numero'])) {
            // si no tiene número, generamos el número correspondiente
            BusinessDocumentCode::setNewNumber($deliveryNote);
        }
        // guardamos
        $lines = [];
        if (false === Calculator::calculate($deliveryNote, $lines, true)) {
            ToolBox::log()->error('invoice-error: ' . $deliveryNote->codigo . ', ' . $deliveryNote->fecha . ' (' . $item['albaranescli.fecha'] . ')');
            return false;
        }

        // añadimos la línea a la albarán
        if (false === $this->newLine($deliveryNote, $item)) {
            ToolBox::log()->error('invoice-line-error: ' . $deliveryNote->codigo);
            return false;
        }

        // actualizamos los totales de la albarán
        $lines = $deliveryNote->getLines();
        if (false === Calculator::calculate($deliveryNote, $lines, true)) {
            ToolBox::log()->error('invoice-calculation-error: ' . $deliveryNote->codigo);
            return false;
        }

        // añadimos a la lista de albaranes procesados
        $this->processingDeliveryNotes[] = $deliveryNote->idalbaran;
        return true;
    }

    protected function newLine(AlbaranCliente $deliveryNote, array $item): bool
    {
        // si tenemos el neto del albarán, pero no el precio de la línea, entonces creamos una línea con el neto
        if (isset($item['albaranescli.neto'], $item['albaranescli.totaliva'], $item['albaranescli.total']) &&
            false === isset($item['lineasalbaranescli.pvpunitario'])) {
            $line = $deliveryNote->getNewLine();
            $line->cantidad = 1;
            $line->descripcion = 'Totales';

            // calculamos en base a los totales
            $neto = isset($item['albaranescli.neto']) ? static::getFloat($item['albaranescli.neto']) : 0.0;
            $totalIva = isset($item['albaranescli.totaliva']) ? static::getFloat($item['albaranescli.totaliva']) : 0.0;
            $iva = empty($neto) ? 0 : $totalIva * 100 / $neto;
            $totalRecargo = isset($item['albaranescli.totalrecargo']) ? static::getFloat($item['albaranescli.totalrecargo']) : 0.0;
            $recargo = empty($neto) ? 0 : $totalRecargo * 100 / $neto;
            $this->setLineTax($line, $iva, $recargo);

            $total = isset($item['albaranescli.total']) ? static::getFloat($item['albaranescli.total']) : 0.0;
            $line->pvpunitario = $total - $totalIva - $totalRecargo;
            $line->pvptotal = $total;
            return $line->save();
        }

        // en caso contrario, creamos una línea con los datos que nos han proporcionado
        $referencia = $item['lineasalbaranescli.referencia'] ?? '';
        $line = $deliveryNote->getNewProductLine($referencia);
        $line->descripcion = $item['lineasalbaranescli.descripcion'] ?? $line->descripcion;
        $line->cantidad = isset($item['lineasalbaranescli.cantidad']) ? static::getFloat($item['lineasalbaranescli.cantidad']) : $line->cantidad;
        $line->dtopor = isset($item['lineasalbaranescli.dtopor']) ? static::getFloat($item['lineasalbaranescli.dtopor']) : $line->dtopor;
        $line->dtopor2 = isset($item['lineasalbaranescli.dtopor2']) ? static::getFloat($item['lineasalbaranescli.dtopor2']) : $line->dtopor2;
        $line->pvpunitario = isset($item['lineasalbaranescli.pvpunitario']) ? static::getFloat($item['lineasalbaranescli.pvpunitario']) : $line->pvpunitario;
        $line->irpf = isset($item['lineasalbaranescli.irpf']) ? static::getFloat($item['lineasalbaranescli.irpf']) : $line->irpf;
        $line->suplido = (bool)($item['lineasalbaranescli.suplido'] ?? 0);

        $iva = isset($item['lineasalbaranescli.iva']) ? static::getFloat($item['lineasalbaranescli.iva']) : $line->iva;
        $recargo = isset($item['lineasalbaranescli.recargo']) ? static::getFloat($item['lineasalbaranescli.recargo']) : $line->recargo;
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

                case 'codpais':
                    if (empty($values[$prefix . $key])) {
                        $model->{$key} = $model->codpais;
                        break;
                    }

                    $country = new Pais();
                    $where = [
                        new DataBaseWhere('codiso', $values[$prefix . $key]),
                        new DataBaseWhere('codpais', $values[$prefix . $key], '=', 'OR')
                    ];
                    if (false === $country->loadFromCode('', $where)) {
                        // creamos el país
                        $country->codpais = $values[$prefix . $key];
                        $country->nombre = $values[$prefix . $key];
                        if (false === $country->save()) {
                            return false;
                        }
                    }
                    $model->{$key} = $country->codpais;
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
                        ToolBox::i18nLog()->warning('invalid-invoice-number', ['%number%' => $values[$prefix . $key]]);
                        return false;
                    }
                    break;
            }
        }
        return true;
    }
}
