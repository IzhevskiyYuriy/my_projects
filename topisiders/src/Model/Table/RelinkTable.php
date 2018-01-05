<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class RelinkTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('relink');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
    }

    /**
     * Returns the database connection name to use by default.
     *
     * @return string
     */
    public static function defaultConnectionName()
    {
        return 'teaser';
    }
}
