<?php
/**
 * Copyright (C) 2022 Carlos Garcia Gomez <carlos@facturascripts.com>
 */

namespace FacturaScripts\Plugins\CSVimport;

use FacturaScripts\Core\Base\CronClass;
use FacturaScripts\Core\Base\DataBase\DataBaseWhere;
use FacturaScripts\Plugins\CSVimport\Model\CSVfile;

/**
 * Description of Cron
 *
 * @author Daniel Fernandez Giménez <hola@danielfg.es>
 */
class Cron extends CronClass
{
    public function run()
    {
        $csvModel = new CSVfile();
        $where = [
            new DataBaseWhere('template', null, 'IS NOT'),
            new DataBaseWhere('url', null, 'IS NOT'),
            new DataBaseWhere('options', null, 'IS NOT'),
            new DataBaseWhere('expiration', 0, '>')
        ];
        foreach ($csvModel->all($where, [], 0, 0) as $csv) {
            if (false === $this->isTimeForJob($csv->template, $csv->expiration . ' ' . $csv->expirationtype)) {
                continue;
            }

            if ($csv->save()) {
                $csv->getProfile(0, 0, null, null, false)->import();
            }

            $this->jobDone($csv->template);
        }
    }
}