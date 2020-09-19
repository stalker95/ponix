<?php
use Migrations\AbstractMigration;

class CreateMediaTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */

    public function up() {
     $table=$this->table('media');
     $table->addColumn('name','string',['default' => null, 'null' => true]);
     $table->addColumn('file','string',['default' => null, 'null' => true]);
     $table->addColumn('created', 'datetime', ['default' => null, 'null' => true]);
     $table->addColumn('modified', 'datetime', ['default' => null, 'null' => true]);
     $table->addColumn('type', 'text', ['default' => null, 'null' => true]);    
     $table->addColumn('active', 'boolean', ['default' => null, 'null' => true]);    
     $table->create();
    }

    public function down() {

    }
}