<?php
/**
 * Copyright (C) 2019-2023 Carlos Garcia Gomez <carlos@facturascripts.com>
 */

namespace FacturaScripts\Plugins\CSVimport\Extension\Controller;

use Closure;
use Exception;
use FacturaScripts\Core\Base\DataBase\DataBaseWhere;
use FacturaScripts\Core\Base\ToolBox;
use FacturaScripts\Plugins\CSVimport\Lib\Import\CsvFileTools;
use FacturaScripts\Plugins\CSVimport\Lib\ImportProfile\ProfileClass;
use FacturaScripts\Plugins\CSVimport\Lib\ImportProfile\SuppliersProfile;
use FacturaScripts\Plugins\CSVimport\Model\CSVfile;

/**
 * Description of ListProveedor
 *
 * @author Carlos Garcia Gomez      <carlos@facturascripts.com>
 * @author Daniel Fernandez Giménez <hola@danielfg.es>
 */
class ListProveedor
{
    public function createViews(): Closure
    {
        return function () {
            // import button
            if ($this->permissions->allowImport) {
                $this->addButton('ListProveedor', [
                    'action' => 'upload-suppliers',
                    'icon' => 'fas fa-file-import',
                    'label' => 'import-suppliers',
                    'type' => 'modal'
                ]);
            }
        };
    }

    public function execPreviousAction(): Closure
    {
        return function ($action) {
            switch ($action) {
                case 'import-suppliers':
                    $this->importSuppliersAction();
                    break;

                case 'upload-suppliers':
                    $this->uploadSuppliersAction();
                    break;
            }
        };
    }

    public function importSuppliersAction(): Closure
    {
        return function () {
            // obtenemos la ruta completa del archivo
            $fileName = $this->request->get('import-filename');
            $filePath = SuppliersProfile::getFilePath($fileName);
            if (empty($filePath)) {
                return true;
            }

            // se ha elegido crea nueva plantilla
            $template = $this->request->get('import-template', 'new-template');
            if ($template === 'new-template') {
                $newCsvFile = CSVfile::newTemplate($fileName, 'suppliers');
                $newCsvFile->mode = $this->request->get('import-mode');
                if ($newCsvFile->save()) {
                    $this->redirect($newCsvFile->url());
                }
                return true;
            }

            // seleccionamos la plantilla
            $templateModel = $template === 'automatic' ?
                SuppliersProfile::getFileTemplate($filePath) :
                SuppliersProfile::getFileTemplate($filePath, $template);
            if (is_null($templateModel)) {
                ToolBox::i18nLog()->warning('template-not-found');

                // creamos una nueva plantilla
                $newCsvFile = CSVfile::newTemplate($fileName, 'suppliers');
                $newCsvFile->mode = $this->request->get('import-mode');
                if ($newCsvFile->save()) {
                    $this->redirect($newCsvFile->url(), 1);
                }
                return true;
            }

            // procesamos el archivo
            $mode = $this->request->get('import-mode');
            $offset = (int)$this->request->get('import-offset', 0);
            $saveLines = (int)$this->request->get('save-lines', 0);
            $result = $templateModel->getProfile($offset, $saveLines, $filePath, $mode)->import();
            if ($result['offset'] > 0 && $result['offset'] < $result['total']) {
                ToolBox::i18nLog()->notice(
                    'items-save-correctly-to-total',
                    ['%lines%' => $result['offset'], '%total%' => $result['total'], '%save%' => $result['save']]
                );
                ToolBox::i18nLog()->notice('importing');
                $this->redirect($this->url() . '?action=import-suppliers&import-filename=' . $fileName . '&import-offset='
                    . $result['offset'] . '&save-lines=' . $result['save'] . '&import-template=' . $templateModel->id
                    . '&import-mode=' . $mode, 1);
                return true;
            }

            unlink($filePath);
            ToolBox::i18nLog()->notice('items-added-correctly', ['%num%' => $result['save']]);
            return true;
        };
    }

    public function loadData(): Closure
    {
        return function ($viewName, $view) {
            if ($viewName !== 'ListProveedor') {
                return;
            }

            // rellenamos el select de plantillas del modal
            $column = $this->views[$viewName]->columnModalForName('template');
            if ($column && $column->widget->getType() === 'select') {
                // añadimos las opciones automatic y new
                $customValues = [
                    ['value' => 'automatic', 'title' => ToolBox::i18n()->trans('automatic-template')],
                    ['value' => 'new-template', 'title' => ToolBox::i18n()->trans('new-template')]
                ];

                // añadimos la lista de plantillas compatibles
                $csvFile = new CSVfile();
                $where = [
                    new DataBaseWhere('template', null, 'IS NOT'),
                    new DataBaseWhere('options', null, 'IS NOT'),
                    new DataBaseWhere('profile', 'suppliers')
                ];
                $templates = $csvFile->all($where, ['template' => 'ASC'], 0, 0);
                if ($templates) {
                    $customValues[] = ['value' => '', 'title' => '------'];
                }
                foreach ($templates as $csv) {
                    $customValues[] = ['value' => $csv->id, 'title' => $csv->template];
                }

                // asignamos el valor predeterminado
                $view->model->template = 'new-template';

                // cargamos la lista de valores
                $column->widget->setValuesFromArray($customValues);
            }
        };
    }

    public function uploadSuppliersAction(): Closure
    {
        return function () {
            // comprobamos los permisos de importación
            if (false === $this->permissions->allowImport) {
                ToolBox::i18nLog()->warning('no-import-permission');
                return true;
            }

            // comprobamos el token
            if (false === $this->validateFormToken()) {
                return true;
            }

            // comprobamos el tamaño y tipo del archivo
            $uploadFile = $this->request->files->get('suppliersfile');
            if (CsvFileTools::isBigFile($uploadFile) || false === CsvFileTools::isValidFile($uploadFile->getRealPath())) {
                return true;
            }

            try {
                // movemos el archivo
                $path = CsvFileTools::saveUploadFile($uploadFile);

                // convertimos el archivo a CSV, si es necesario
                $filePath = CsvFileTools::convertFileToCsv($path);
            } catch (Exception $exc) {
                ToolBox::i18nLog()->warning('upload-file-error');
                ToolBox::i18nLog()->warning($uploadFile->getClientOriginalName());
                ToolBox::i18nLog()->warning($exc->getMessage());
                return true;
            }

            // recargamos la página para llamar a la acción de importación
            $fileName = basename($filePath);
            $template = $this->request->request->get('template', ProfileClass::AUTOMATIC);
            $mode = $this->request->request->get('mode', ProfileClass::AUTOMATIC);
            $this->redirect($this->url() . '?action=import-suppliers&import-filename=' . urlencode($fileName)
                . '&import-template=' . $template . '&import-mode=' . $mode);
            return true;
        };
    }
}
