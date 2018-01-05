<?php
use Migrations\AbstractMigration;

class ChangeBlocksCssTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $blocksTable = $this->table('blocks');
        $blocksTable->dropForeignKey('block_css_id')
            ->removeIndex(['block_css_id'])
            ->removeColumn('block_css_id')
            ->update();

        $this->execute('DELETE FROM blocks');
        $this->execute('DELETE FROM blocks_css');

        $table = $this->table('blocks_css');
        $table->rename('blocks_styles')
            ->addColumn('block_id', 'integer', [
            'default' => null,
            'null' => false,
            'limit' => 11
        ])
            ->addIndex(['block_id'])
            ->addForeignKey('block_id', 'blocks')
            ->update();

    }
}
