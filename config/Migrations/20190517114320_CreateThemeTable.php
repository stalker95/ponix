<?php
use Migrations\AbstractMigration;

class CreateThemeTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function up() {
     $table=$this->table('themes');
     $table->addColumn('name','string',['default' => null, 'null' => true]);
     $table->addColumn('class','string',['default' => null, 'null' => true]);
     $table->create();
    }

    public function down() {

    }
}
