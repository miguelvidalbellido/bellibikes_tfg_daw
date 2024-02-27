<?php
/**
 * Copyright (C) 2020-2023 Carlos Garcia Gomez <carlos@facturascripts.com>
 */

namespace FacturaScripts\Plugins\CSVimport\Lib\ImportProfile;

use Exception;
use FacturaScripts\Core\Base\DataBase;
use FacturaScripts\Core\Base\DataBase\DataBaseWhere;
use FacturaScripts\Core\Base\ToolBox;
use FacturaScripts\Core\Model\Base\ModelClass;
use FacturaScripts\Core\Model\Base\ModelCore;
use FacturaScripts\Plugins\CSVimport\Model\CSVfile;
use ParseCsv\Csv;

/**
 * Description of ProfileClass
 *
 * @author Carlos Garcia Gomez      <carlos@facturascripts.com>
 * @author Daniel Fernandez Giménez <hola@danielfg.es>
 */
abstract class ProfileClass
{
    const AUTOMATIC = 'automatic';
    const INSERT_MODE = 'insert';
    const LIMIT_IMPORT = 1000;
    const METHOD_IMPORT = 'importItem';
    const MAX_VALUE_LEN = 30;
    const NEW_TEMPLATE = 'new-template';
    const UPDATE_MODE = 'update';

    /** @var Csv */
    protected $csv;

    /** @var CSVfile */
    protected $model;

    /** @var int */
    protected $csvTotal = 0;

    /** @var int */
    protected $offset = 0;

    /** @var int */
    protected $saveLines = 0;

    abstract public function getDataFields(): array;

    abstract public static function getProfile(): string;

    abstract protected function getFileType(): string;

    abstract protected function importItem(array $item): bool;

    public function __construct(CSVfile $model, ?int $offset, int $saveLines, ?int $limit)
    {
        $this->model = $model;
        $offset = $offset + ($model->startline > 2 ? $model->startline - 1 : $model->startline);

        $this->csv = new Csv(null, $offset + 1, $limit);
        if ($model->noutf8file) {
            $this->csv->encoding(null, 'UTF-8');
        }
        if (false === file_exists($model->path)) {
            return;
        }

        $filePath = FS_FOLDER . DIRECTORY_SEPARATOR . $model->path;
        $this->csv->auto($filePath);
        $this->csvTotal = static::getCsvTotal($filePath);
        $this->offset = $offset;
        $this->saveLines = $saveLines;

        // ¿Los títulos no están en la primera línea?
        if ($model->startline > 0) {
            $csv = new Csv();
            $csv->auto($filePath);
            $this->csv->titles = [];

            // asignamos los nuevos títulos
            $index = $model->startline !== 2 ? max($model->startline - 2, 0) : 1;
            if (isset($csv->data[$index])) {
                foreach ($csv->data[$index] as $value) {
                    $this->csv->titles[] = $value;
                }
            }

            // reasignamos las columnas
            foreach ($this->csv->data as $index => $row) {
                $newRow = [];
                $pos = 0;
                foreach ($row as $column) {
                    $key = $this->csv->titles[$pos];
                    $newRow[$key] = $column;
                    $pos++;
                }
                $this->csv->data[$index] = $newRow;
            }
        }
    }

    public function getCsv(): Csv
    {
        return $this->csv;
    }

    public static function getFilePath($fileName): string
    {
        $filePath = FS_FOLDER . DIRECTORY_SEPARATOR . 'MyFiles' . DIRECTORY_SEPARATOR . $fileName;
        if (false === file_exists($filePath)) {
            ToolBox::i18nLog()->warning('file-not-found', ['%fileName%' => $filePath]);
            return '';
        }

        return $filePath;
    }

    public static function getFileTemplate(string $filePath, int $idtemplate = 0): ?CSVfile
    {
        $templateModel = new CSVfile();

        $where = $idtemplate > 0 ?
            [new DataBaseWhere('id', $idtemplate)] :
            [new DataBaseWhere('profile', static::getProfile())];
        $where[] = new DataBaseWhere('options', null, 'IS NOT');

        foreach ($templateModel->all($where, [], 0, 0) as $template) {
            $csv = $template->getProfile(0, 0, $filePath)->getCsv();
            if (empty($csv->titles)) {
                // si la plantilla no tiene títulos, la excluimos, no está configurada
                continue;
            }

            $cont = 0;
            $csvColumns = json_decode($template->csvcolumns, true);
            foreach ($csvColumns as $key => $value) {
                $index = str_replace('field', '', $key);
                if (isset($csv->titles[$index]) && $csv->titles[$index] === $value) {
                    $cont++;
                }
            }

            if (count($csvColumns) === $cont) {
                return $template;
            }
        }

        return null;
    }

    public function getRows(int $offset = 0): array
    {
        $rows = [];
        foreach ($this->csv->titles as $title) {
            if (empty($title)) {
                continue;
            }

            $rows[] = [
                'title' => $title,
                'value1' => '',
                'value2' => '',
                'value3' => '',
                'use' => ''
            ];
        }

        $this->setValues($rows);
        return $rows;
    }

    public function import(): array
    {
        $numLines = 0;
        $numSave = 0;

        // get transformations
        $transformations = [];
        foreach ($this->getRows() as $row) {
            if (!empty($row['use'])) {
                $transformations[$row['use']] = $row['title'];
            }
        }

        // start transaction
        $dataBase = new DataBase();
        $dataBase->beginTransaction();

        try {
            $method = $this->getFileType();

            if ($method === self::METHOD_IMPORT) {
                foreach ($this->csv->data as $line) {
                    $numLines++;
                    $item = [];
                    foreach ($transformations as $key => $field) {
                        $item[$key] = $line[$field];
                    }

                    if ($this->importItem($item)) {
                        $numSave++;
                    }
                }
            } else {
                $this->$method($numLines, $numSave);
            }

            // confirm data
            $dataBase->commit();
        } catch (Exception $exp) {
            $this->toolBox()->log()->error($exp->getMessage() . ' ' . $exp->getFile() . ' ' . $exp->getLine());
        } finally {
            if ($dataBase->inTransaction()) {
                $dataBase->rollback();
            }
        }

        $this->offset += $numLines;
        $this->saveLines += $numSave;
        return ['save' => $this->saveLines, 'offset' => $this->offset, 'total' => $this->csvTotal, 'options' => $this->model->options];
    }

    protected function formatString(string $txt, int $length, int $offset = 0): string
    {
        return substr($txt, $offset, $length);
    }

    protected static function getCsvTotal($filePath)
    {
        $csv = new Csv();
        $csv->auto($filePath);
        return count($csv->data);
    }

    protected function getDate(?string $text): ?string
    {
        if (empty($text)) {
            return null;
        }

        // si la fecha tiene un espacio, nos quedamos con la primera parte
        $text = explode(' ', $text)[0];

        // comprobamos si el separador de fecha es / o -
        $sep = strpos($text, '/') !== false ? '/' : '-';

        // partimos la fecha, si no hay 3 trozos, devolvemos null
        $parts = explode($sep, $text);
        if (count($parts) !== 3) {
            return null;
        }

        // si el primer y tercer valor tiene 2 dígitos y es mayor que 80, le sumamos 1900, sino 2000
        if (strlen($parts[0]) === 2 && strlen($parts[2]) === 2) {
            $parts[2] = (int)$parts[2] > 80 ? '19' . $parts[2] : '20' . $parts[2];
        }

        // si el separador es '-' y el segundo valor es mayor que 12, lanzamos una excepción
        if ($sep === '-' && (int)$parts[1] > 12) {
            throw new Exception('Invalid date: ' . $text);
        }

        // componemos la nueva fecha
        $newText = strlen($parts[2]) > strlen($parts[0]) ?
            $parts[2] . '-' . $parts[1] . '-' . $parts[0] :
            $parts[0] . '-' . $parts[1] . '-' . $parts[2];
        return date(ModelCore::DATE_STYLE, strtotime($newText));
    }

    protected static function getFloat(string $value): float
    {
        if (empty($value)) {
            return 0.0;
        }

        // eliminamos todos los caracteres que no sean números, guión, coma o punto
        $value = preg_replace('/[^0-9\-\.,]/', '', $value);

        // si hay coma y punto, cambiamos el punto por nada
        if (strpos($value, ',') !== false && strpos($value, '.') !== false) {
            $value = str_replace('.', '', $value);
        }

        // cambiamos la coma por punto
        return (float)str_replace(',', '.', $value);
    }

    protected function getValidEmail($text): string
    {
        if (empty($text)) {
            return '';
        }

        foreach (explode(' ', $text) as $part) {
            if (filter_var($part, FILTER_VALIDATE_EMAIL)) {
                return $part;
            }
        }

        return '';
    }

    protected function setModelValues(ModelClass &$model, array $values, string $prefix): bool
    {
        foreach ($model->getModelFields() as $key => $field) {
            if (!isset($values[$prefix . $key])) {
                continue;
            }

            switch ($field['type']) {
                case 'date':
                    $model->{$key} = $this->getDate($values[$prefix . $key]);
                    break;

                case 'double':
                case 'double precision':
                case 'float':
                    $model->{$key} = (float)\str_replace(',', '.', $values[$prefix . $key]);
                    break;

                default:
                    $model->{$key} = $values[$prefix . $key];
            }

            if ($field['name'] == 'email') {
                $model->{$key} = $this->getValidEmail($model->{$key});
            }
        }
        return true;
    }

    protected function setValues(array &$rows)
    {
        foreach ($this->csv->data as $num0 => $line) {
            $num = 1 + $num0;
            foreach ($rows as $key => $row) {
                if (!isset($row['value' . $num])) {
                    break;
                }

                $value = $line[$row['title']] ?? null;
                if (is_string($value) && strlen($value) > static::MAX_VALUE_LEN) {
                    $rows[$key]['value' . $num] = substr($value, 0, static::MAX_VALUE_LEN) . '...';
                    continue;
                }

                $rows[$key]['value' . $num] = $value;
            }
        }

        foreach (array_keys($rows) as $key) {
            if (isset($this->model->options['field' . $key])) {
                $rows[$key]['use'] = $this->model->options['field' . $key];
            }
        }
    }

    protected function toolBox(): ToolBox
    {
        return new ToolBox();
    }
}
