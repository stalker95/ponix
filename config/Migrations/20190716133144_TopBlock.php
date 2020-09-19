<?php
use Migrations\AbstractMigration;

class TopBlock extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function up() {

     $table=$this->table('top_block');
     $table->addColumn('image','string',['default' => null, 'null' => true]);
     $table->addColumn('name','string',['default' => null, 'null' => true]);
     $table->create();
     
    }

    public function down() {

    }
}
