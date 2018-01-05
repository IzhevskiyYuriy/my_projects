<?php
use Migrations\AbstractMigration;

class AddBlockCssIdToBlocks extends AbstractMigration
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
        $this->execute('DELETE FROM blocks');

        $table = $this->table('blocks');
        $table->addColumn('block_css_id', 'integer', [
            'default' => null,
            'null' => false,
            'limit' => 11
        ])
            ->addIndex(['block_css_id'])
            ->addForeignKey('block_css_id', 'blocks_css');
        $table->update();
    }
}
