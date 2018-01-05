<?php
use Migrations\AbstractMigration;

class ChangeColumnPriceTypeInTeasers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function up()
    {
        $teasers = $this->table('teasers');
        // $teasers->removeColumn('price');
        $teasers->changeColumn('price', 'decimal', [
            'default' => 0,
            'null' => true,
            'precision' => 10,
            'scale' => 3,
            'signed' => 'unsigned'
        ])
            ->update();
    }

    public function down()
    {

    }
}
