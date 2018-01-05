<?php
use Migrations\AbstractMigration;

class AddTypeToAccounts extends AbstractMigration
{

    public function up()
    {
    }

    public function down()
    {
        $table = $this->table('accounts');
        $table->removeColumn('type')
              ->save();
    }
    
    public function change()
    {
        $table = $this->table('accounts');
        $table->addColumn('type', 'enum', [
            'values' => ['advert', 'webmaster']
        ])
              ->update();
    }
}

