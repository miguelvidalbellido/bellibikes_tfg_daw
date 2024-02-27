<?php
/**
 * Copyright (C) 2019-2020 Carlos Garcia Gomez <carlos@facturascripts.com>
 */
namespace FacturaScripts\Plugins\CSVimport\Lib\Import;

use FacturaScripts\Core\Base\DataBase\DataBaseWhere;
use FacturaScripts\Dinamic\Model\Contacto;

/**
 * Description of ContactImport
 *
 * @author Carlos Garcia Gomez <carlos@facturascripts.com>
 */
class ContactImport extends CsvImporClass
{

    /**
     * 
     * @param string $first
     * @param string $second
     * @param string $third
     *
     * @return string
     */
    protected static function findOne($first, $second, $third)
    {
        if (!empty($first)) {
            return $first;
        }

        if (!empty($second)) {
            return $second;
        }

        if (!empty($third)) {
            return $third;
        }

        return 'contacts';
    }

    /**
     * 
     * @param string $txt
     * @param array  $values
     *
     * @return array
     */
    protected static function findValues($txt, $values = [])
    {
        foreach (\explode(' ::: ', $txt) as $part) {
            $value = \trim($part);
            if (!empty($value)) {
                $values[] = $value;
            }
        }

        return $values;
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
            return self::TYPE_NONE;
        } elseif ($csv->titles[0] === 'Name' && $csv->titles[1] === 'Given Name') {
            return self::TYPE_GOOGLE;
        } elseif ($csv->titles[0] === 'First Name' && $csv->titles[1] === 'Middle Name') {
            return self::TYPE_OUTLOOK;
        } elseif ($csv->titles[0] === 'aceptaprivacidad' && $csv->titles[1] === 'admitemarketing') {
            return self::TYPE_FACTURASCRIPTS;
        }

        return self::TYPE_NONE;
    }

    protected static function getProfile()
    {
        return 'contacts';
    }

    /**
     *
     * @param string $filePath
     * @param string $mode
     * @param int $offset
     * @return array
     */
    public static function importCSVfs(string $filePath, string $mode, int $offset, array $params): array
    {
        $csv = static::getCsv($filePath, $offset);

        $numSave = 0;
        $numLines = 0;
        foreach ($csv->data as $row) {
            $numLines++;
            /// find contact
            $contacto = new Contacto();
            $where = [];
            if (!empty($row['email'])) {
                $where[] = new DataBaseWhere('email', $row['email']);
            }
            if (!empty($row['telefono1'])) {
                $where[] = new DataBaseWhere('telefono1', $row['telefono1']);
            }
            if (empty($where) || ($contacto->loadFromCode('', $where) && $mode === self::INSERT_MODE)) {
                continue;
            }

            /// save new contact
            $contacto->loadFromData($row, [$contacto->primaryColumn(), 'codagente', 'codcliente', 'codproveedor']);
            $contacto->idfuente = empty($params['idfuente']) ? null : $params['idfuente'];
            if ($contacto->save()) {
                $numSave++;
            }
        }

        return ['save' => $numSave, 'lines' => $numLines];
    }

    /**
     *
     * @param string $filePath
     * @param string $mode
     * @param int $offset
     * @param array $params
     * @return array
     */
    public static function importCSVgoole(string $filePath, string $mode, int $offset, array $params): array
    {
        $csv = static::getCsv($filePath, $offset);

        $numSave = 0;
        $numLines = 0;
        foreach ($csv->data as $row) {
            $numLines++;
            /// extract emails and phones
            $emails = self::findValues($row['E-mail 1 - Value']);
            $emails = self::findValues($row['E-mail 2 - Value'], $emails);
            $emails = self::findValues($row['E-mail 3 - Value'], $emails);
            $emails = self::findValues($row['E-mail 4 - Value'], $emails);
            $phones = self::findValues($row['Phone 1 - Value']);
            $phones = self::findValues($row['Phone 2 - Value'], $phones);
            $phones = self::findValues($row['Phone 3 - Value'], $phones);

            /// find contact
            $contacto = new Contacto();
            $where = [];
            if (!empty($emails)) {
                $where[] = new DataBaseWhere('email', $emails[0]);
            }
            if (!empty($phones)) {
                $where[] = new DataBaseWhere('telefono1', $phones[0]);
            }
            if (empty($where) || ($contacto->loadFromCode('', $where) && $mode === self::INSERT_MODE)) {
                continue;
            }

            /// save new contact
            $contacto->apellidos = $row['Family Name'];
            $contacto->email = $emails[0] ?? '';
            $contacto->idfuente = empty($params['idfuente']) ? null : $params['idfuente'];
            $contacto->telefono1 = $phones[0] ?? '';
            $contacto->telefono2 = $phones[1] ?? '';
            $contacto->nombre = self::findOne($row['Name'], $contacto->email, $contacto->telefono1);
            if ($contacto->save()) {
                $numSave++;
            }
        }

        return ['save' => $numSave, 'lines' => $numLines];
    }

    /**
     *
     * @param string $filePath
     * @param string $mode
     * @param int $offset
     * @param array $params
     * @return array
     */
    public static function importCSVoutlook(string $filePath, string $mode, int $offset, array $params): array
    {
        $csv = static::getCsv($filePath, $offset);

        $numSave = 0;
        $numLines = 0;
        foreach ($csv->data as $row) {
            $numLines++;
            /// extract emails and phones
            $emails = self::findValues($row['E-mail Address']);
            $emails = self::findValues($row['E-mail 2 Address'], $emails);
            $emails = self::findValues($row['E-mail 3 Address'], $emails);
            $phones = self::findValues($row['Primary Phone']);
            $phones = self::findValues($row['Home Phone'], $phones);
            $phones = self::findValues($row['Home Phone 2'], $phones);
            $phones = self::findValues($row['Mobile Phone'], $phones);
            $phones = self::findValues($row['Business Phone'], $phones);
            $phones = self::findValues($row['Business Phone 2'], $phones);
            $phones = self::findValues($row['Other Phone'] ?? '', $phones);

            /// find contact
            $contacto = new Contacto();
            $where = [];
            if (!empty($emails)) {
                $where[] = new DataBaseWhere('email', $emails[0]);
            }
            if (!empty($phones)) {
                $where[] = new DataBaseWhere('telefono1', $phones[0]);
            }
            if (empty($where) || ($contacto->loadFromCode('', $where) && $mode === self::INSERT_MODE)) {
                continue;
            }

            /// save new contact
            if (isset($row['Home Address PO Box'])) {
                $contacto->apartado = self::findOne($row['Home Address PO Box'], $row['Business Address PO Box'], $row['Other Address PO Box']);
            }
            $contacto->apellidos = empty($row['Middle Name']) ? $row['Last Name'] : $row['Middle Name'] . ' ' . $row['Last Name'];
            $contacto->ciudad = self::findOne($row['Home City'], $row['Business City'], $row['Other City'] ?? '');
            if (isset($row['Home Country'])) {
                $contacto->codpais = self::findOne($row['Home Country'], $row['Business Country'], $row['Other Country'] ?? '');
            }
            if (isset($row['Home Address'])) {
                $contacto->codpostal = self::findOne($row['Home Address'], $row['Business Address'], $row['Other Address']);
            }
            if (isset($row['Home Postal Code'])) {
                $contacto->direccion = self::findOne($row['Home Postal Code'], $row['Business Postal Code'], $row['Other Postal Code'] ?? '');
            }
            $contacto->email = $emails[0] ?? '';
            $contacto->idfuente = empty($params['idfuente']) ? null : $params['idfuente'];
            $contacto->provincia = self::findOne($row['Home State'], $row['Business State'], $row['Other State'] ?? '');
            $contacto->telefono1 = $phones[0] ?? '';
            $contacto->telefono2 = $phones[1] ?? '';
            $contacto->nombre = self::findOne($row['First Name'], $contacto->email, $contacto->telefono1);
            if ($contacto->save()) {
                $numSave++;
            }
        }

        return ['save' => $numSave, 'lines' => $numLines];
    }

    protected static function importType(int $type, string $filePath, string $mode, int $offset, array $params): array
    {
        switch ($type) {
            case self::TYPE_FACTURASCRIPTS:
                return static::importCSVfs($filePath, $mode, $offset, $params);

            case self::TYPE_GOOGLE:
                return static::importCSVgoole($filePath, $mode, $offset, $params);

            case self::TYPE_OUTLOOK:
                return static::importCSVoutlook($filePath, $mode, $offset, $params);

            default:
                static::toolBox()->i18nLog()->warning('file-not-supported-advanced');
                return ['save' => 0, 'lines' => 0];
        }
    }
}
