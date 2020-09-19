<?php
use Migrations\AbstractMigration;

class CreateMarqueTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function up() {
     $table=$this->table('marques');
     $table->addColumn('text','string',['default' => null, 'null' => true]);
     $table->create();
    }

    public function down() {

    }
}
