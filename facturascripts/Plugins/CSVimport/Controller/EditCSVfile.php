<?php
/**
 * Copyright (C) 2020-2023 Carlos Garcia Gomez <carlos@facturascripts.com>
 */

namespace FacturaScripts\Plugins\CSVimport\Controller;

use Exception;
use FacturaScripts\Core\Lib\ExtendedController\EditController;
use FacturaScripts\Plugins\CSVimport\Lib\Import\CsvFileTools;
use FacturaScripts\Plugins\CSVimport\Model\CSVfile;

/**
 * Description of EditCSVfile
 *
 * @author Carlos Garcia Gomez      <carlos@facturascripts.com>
 * @author Daniel Fernandez Giménez <hola@danielfg.es>
 */
class EditCSVfile extends EditController
{
    public function getModelClassName(): string
    {
        return 'CSVfile';
    }

    public function getPageData(): array
    {
        $pageData = parent::getPageData();
        $pageData['menu'] = 'admin';
        $pageData['title'] = 'csv-file';
        $pageData['icon'] = 'fas fa-file-csv';
        return $pageData;
    }

    protected function createViews()
    {
        parent::createViews();
        $this->setTabsPosition('bottom');
        $this->createViewsFields();
    }

    protected function createViewsFields(string $viewName = 'CSVfields'): void
    {
        $this->addHtmlView($viewName, 'CSVfields', 'CSVfile', 'fields', 'fas fa-cogs');
    }

    protected function execAfterAction($action)
    {
        parent::execAfterAction($action);
        if ($action === 'import') {
            $this->importCsvAction();
        }
    }

    protected function execPreviousAction($action)
    {
        switch ($action) {
            case 'upload-new-file':
                $this->uploadNewFileAction();
                break;

            case 'save-columns':
                $this->saveColumnsAction();
                break;
        }

        return parent::execPreviousAction($action);
    }

    protected function importCsvAction(): void
    {
        $offset = (int)$this->request->get('import-offset', '0');
        $saveLines = (int)$this->request->get('save-lines', '0');
        if ($offset === 0 && false === $this->saveColumnsAction()) {
            return;
        }

        $result = $this->getModel()->getProfile($offset, $saveLines)->import();
        $errors = self::toolBox()::log()->read('', ['error']);
        if ($result['offset'] > 0 && $result['offset'] < $result['total'] && empty($errors)) {
            $this->toolBox()->i18nLog()->notice(
                'items-save-correctly-to-total',
                ['%lines%' => $result['offset'], '%total%' => $result['total'], '%save%' => $result['save']]
            );
            $this->toolBox()->i18nLog()->notice('importing');
            $this->redirect($this->url() . '?code=' . $this->request->get('code') . '&action=import&import-offset='
                . $result['offset'] . '&save-lines=' . $result['save'], 1);
            return;
        }

        $this->toolBox()->i18nLog()->notice('items-added-correctly', ['%num%' => $result['save']]);
    }

    protected function loadData($viewName, $view)
    {
        parent::loadData($viewName, $view);

        if ($viewName === 'EditCSVfile' && false === empty($view->model->path)) {
            $this->addButton('EditCSVfile', [
                'action' => 'upload-new-file',
                'color' => 'warning',
                'icon' => 'fas fa-file-upload',
                'label' => 'upload-file',
                'type' => 'modal'
            ]);
        }
    }

    protected function saveColumnsAction(): bool
    {
        $model = $this->getModel();
        if (false === $model->loadFromCode($this->request->get('code'))) {
            return false;
        }

        $options = [];
        $exclude = ['action', 'import-offset', 'multireqtoken', 'save-lines'];
        foreach ($this->request->request->all() as $key => $value) {
            if (!empty($value) && !in_array($key, $exclude)) {
                $options[$key] = $value;
            }
        }

        if (false === $model->setOptions($options)) {
            return false;
        }

        $columns = [];
        $titles = $model->getProfile()->getCsv()->titles;
        foreach ($options as $key => $value) {
            $index = str_replace('field', '', $key);
            $columns[$key] = $titles[$index];
        }

        return $model->setCsvColumns($columns);
    }

    protected function uploadNewFileAction(): void
    {
        if (false === $this->validateFormToken()) {
            return;
        }

        // cargamos el modelo
        $model = new CSVfile();
        if (false === $model->loadFromCode($this->request->get('code'))) {
            self::toolBox()::i18nLog()->error('record-not-found');
            return;
        }

        // comprobamos el tamaño y tipo de archivo
        $uploadFile = $this->request->files->get('newfile');
        if (CsvFileTools::isBigFile($uploadFile) || false === CsvFileTools::isValidFile($uploadFile->getRealPath())) {
            return;
        }

        // movemos y convertimos el archivo
        try {
            $path = CsvFileTools::saveUploadFile($uploadFile);
            $filePath = CsvFileTools::convertFileToCSV($path);
        } catch (Exception $exc) {
            $this->toolBox()->i18nLog()->warning('upload-file-error');
            $this->toolBox()->i18nLog()->warning($uploadFile->getClientOriginalName());
            $this->toolBox()->i18nLog()->warning($exc->getMessage());
            return;
        }

        // asignamos el archivo al modelo
        $model->path = basename($filePath);
        if (false === $model->save()) {
            self::toolBox()::i18nLog()->error('record-save-error');
            return;
        }

        self::toolBox()::i18nLog()->notice('record-updated-correctly');
    }
}
