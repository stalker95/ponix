<?php
use Migrations\AbstractMigration;

class AddNewFieldToUsers extends AbstractMigration
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
        $table = $this->table('users');
        $table->addColumn('allow_read', 'boolean', [
            'default' => 1,
            'null' => false,
        ]);
        $table->addColumn('allow_write', 'boolean', [
            'default' => 0,
            'null' => false,
        ]);
        $table->addColumn('allow_edit', 'boolean', [
            'default' => 0,
            'null' => false,
        ]);
        $table->addColumn('allow_delete', 'boolean', [
            'default' => 0,
            'null' => false,
        ]);
        $table->save();
    }
    public function down() {

    }
}
