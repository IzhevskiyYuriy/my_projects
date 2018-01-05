<?php
namespace app\models;

use fw\core\base\Model;
use fw\core\libs;

class HomePage extends Model
{
    public $table = 'task';

    public function getAllEntries()
    {
        return $this->findBySql(
            "SELECT  t.id, t.name, t.email, t.task, t.img, t.status_id, s.status_name
                      FROM {$this->table} AS t
                          INNER JOIN `status` AS s ON (s.id = t.status_id)
                           ORDER BY id DESC"
        );
    }

    public function getShortText($text)
    {
        return mb_strimwidth($text, 0, 200, "...");
    }




}