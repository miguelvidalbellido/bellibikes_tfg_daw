<?php
/**
 * Copyright (C) 2020-2023 Carlos Garcia Gomez <carlos@facturascripts.com>
 */

namespace FacturaScripts\Plugins\CSVimport\Model;

use FacturaScripts\Core\Model\Base;
use FacturaScripts\Dinamic\Model\AttachedFile;
use FacturaScripts\Plugins\CSVimport\Lib\Import\CsvFileTools;

/**
 * Description of CSVfile
 *
 * @author Carlos Garcia Gomez      <carlos@facturascripts.com>
 * @author Daniel Fernandez Giménez <hola@danielfg.es>
 */
class CSVfile extends Base\ModelClass
{
    use Base\ModelTrait;

    const INSERT_MODE = 'insert';
    const UPDATE_MODE = 'update';

    /** @var string */
    public $codcuenta;

    /** @var string */
    public $csvcolumns;

    /** @var string */
    public $date;

    /** @var int */
    public $expiration;

    /** @var string */
    public $expirationtype;

    /** @var int */
    public $id;

    /** @var int */
    public $idfile;

    /** @var string */
    public $mode;

    /** @var string */
    public $name;

    /** @var bool */
    public $noutf8file;

    /** @var string */
    public $options;

    /** @var string */
    public $path;

    /** @var string */
    public $profile;

    /** @var int */
    public $size;

    /** @var int */
    public $startline;

    /** @var string */
    public $template;

    /** @var string */
    public $url;

    public function clear()
    {
        parent::clear();
        $this->date = date(self::DATE_STYLE);
        $this->expiration = 0;
        $this->mode = self::INSERT_MODE;
        $this->noutf8file = false;
        $this->size = 0;
        $this->startline = 0;
    }

    public function delete(): bool
    {
        $attachedFile = $this->getAttachedFile();
        if ($attachedFile && false === $attachedFile->delete()) {
            return false;
        }

        return parent::delete();
    }

    /**
     * Return the attached file to this build.
     *
     * @return AttachedFile
     */
    public function getAttachedFile(): ?AttachedFile
    {
        $attachedFile = new AttachedFile();
        if ($attachedFile->loadFromCode($this->idfile)) {
            return $attachedFile;
        }

        return null;
    }

    public function getProfile($offset = 0, $saveLines = 0, $filePath = null, $mode = null, bool $limit = true)
    {
        $model = clone $this;
        $profileClass = $this->getProfileClass();
        $limit = $limit ? $profileClass::LIMIT_IMPORT : null;
        $path = is_null($filePath) ? $this->path : $filePath;

        $model->options = empty($model->options) ? [] : json_decode($model->options, true);
        $model->mode = is_null($mode) || $mode === 'automatic' ? $model->mode : $mode;
        $model->path = str_replace(FS_FOLDER . DIRECTORY_SEPARATOR, '', $path);

        return new $profileClass($model, $offset, $saveLines, $limit);
    }

    public static function newTemplate(string $fileName, string $profile): CSVfile
    {
        $newCsvFile = new static();
        $filePath = FS_FOLDER . DIRECTORY_SEPARATOR . 'MyFiles' . DIRECTORY_SEPARATOR . $fileName;
        if (false === file_exists($filePath)) {
            return $newCsvFile;
        }

        $newCsvFile->path = $fileName;
        $newCsvFile->profile = $profile;
        return $newCsvFile;
    }

    public static function primaryColumn(): string
    {
        return 'id';
    }

    public function setCsvColumns(array $values): bool
    {
        $this->csvcolumns = count($values) > 0 ? json_encode($values) : null;
        return $this->save();
    }

    public function setOptions(array $values): bool
    {
        $this->options = count($values) > 0 ? json_encode($values) : null;
        return $this->save();
    }

    public static function tableName(): string
    {
        return 'csv_files';
    }

    public function test(): bool
    {
        if (empty($this->path) && empty($this->url) && empty($this->id)) {
            $this->toolBox()->i18nLog()->warning('file-or-url-required');
            return false;
        }

        $fileName = '';
        $filePath = '';
        $path = FS_FOLDER . DIRECTORY_SEPARATOR . 'MyFiles' . DIRECTORY_SEPARATOR;

        if ($this->url) {
            $fileName = basename($this->url);
            $filePath = $path . $fileName;
            if (!file_put_contents($filePath, file_get_contents($this->url))) {
                $this->toolBox()->i18nLog()->warning('upload-file-error');
                $this->toolBox()->i18nLog()->warning($fileName);
                return false;
            }
        } elseif ($this->path && strpos($this->path, 'MyFiles' . DIRECTORY_SEPARATOR) === false) {
            $fileName = $this->path;
            $filePath = $path . $this->path;
        }

        if (false === empty($fileName) && file_exists($filePath)) {
            if (false === CsvFileTools::isValidFile($filePath)) {
                unlink($filePath);
                return false;
            }

            $filePath = CsvFileTools::convertFileToCsv($filePath);

            $attachedFile = new AttachedFile();
            $attachedFile->path = basename($filePath);
            if (false === $attachedFile->save()) {
                unlink($filePath);
                return false;
            }

            // eliminamos el fichero antiguo
            if ($this->idfile) {
                $oldAttachedFile = new AttachedFile();
                $oldAttachedFile->loadFromCode($this->idfile);
                $oldAttachedFile->delete();
            }

            $this->idfile = $attachedFile->idfile;
            $this->name = $attachedFile->filename;
            $this->path = $attachedFile->path;
            $this->size = $attachedFile->size;
        }

        $this->template = empty($this->template) ? null : $this->template;

        if (in_array($this->mode, ['automatic', 'default'])) {
            $this->mode = self::INSERT_MODE;
        }

        return parent::test();
    }

    public function url(string $type = 'auto', string $list = 'ListAttachedFile?activetab=List'): string
    {
        return parent::url($type, $list);
    }

    protected function getProfileClass(): string
    {
        switch ($this->profile) {
            case 'accounting-entries':
                return '\FacturaScripts\Dinamic\Lib\ImportProfile\AccountingEntriesProfile';

            case 'banking-movements':
                return '\FacturaScripts\Dinamic\Lib\ImportProfile\BankingMovementsProfile';

            case 'contacts':
                return '\FacturaScripts\Dinamic\Lib\ImportProfile\ContactsProfile';

            case 'customer-delivery-notes':
                return '\FacturaScripts\Dinamic\Lib\ImportProfile\CustomerDeliveryNotesProfile';

            case 'customer-invoices':
                return '\FacturaScripts\Dinamic\Lib\ImportProfile\CustomerInvoicesProfile';

            case 'families':
                return '\FacturaScripts\Dinamic\Lib\ImportProfile\FamiliesProfile';

            case 'manufacturers':
                return '\FacturaScripts\Dinamic\Lib\ImportProfile\ManufacturersProfile';

            case 'products':
                return '\FacturaScripts\Dinamic\Lib\ImportProfile\ProductsProfile';

            case 'supplier-invoices':
                return '\FacturaScripts\Dinamic\Lib\ImportProfile\SupplierInvoicesProfile';

            case 'supplier-products':
                return '\FacturaScripts\Dinamic\Lib\ImportProfile\SupplierProductsProfile';

            case 'suppliers':
                return '\FacturaScripts\Dinamic\Lib\ImportProfile\SuppliersProfile';

            case 'variants':
                return '\FacturaScripts\Dinamic\Lib\ImportProfile\VariantsProfile';

            default:
                return '\FacturaScripts\Dinamic\Lib\ImportProfile\CustomersProfile';
        }
    }
}
