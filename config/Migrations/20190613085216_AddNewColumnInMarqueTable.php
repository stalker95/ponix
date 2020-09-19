<?php
use Migrations\AbstractMigration;

class AddNewColumnInMarqueTable extends AbstractMigration
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
        $table = $this->table('marque');
        $table->addColumn('logo', 'string', ['default' => null,'null' => true]);
        $table->addColumn('logo_display', 'boolean', ['default' => null,'null' => true]);
        $table->addColumn('marque_display', 'boolean', ['default' => null,'null' => true]);
        $table->save();
    }
    public function down() {

    }
}
