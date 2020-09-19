<?php
use Migrations\AbstractMigration;

class CategoryTable extends AbstractMigration
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
        $table = $this->table('categories');
        $table->addColumn('name', 'string', ['null' => false]);
        $table->save();

    }
    public function down() {

    }
}
