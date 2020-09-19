<?php
use Migrations\AbstractMigration;

class SolutionTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
     public function up() {
     $table=$this->table('solution');
     $table->addColumn('title','string',['default' => null, 'null' => true]);
     $table->addColumn('image','string',['default' => null, 'null' => true]);
     $table->addColumn('url','string',['default' => null, 'null' => true]);
     $table->addColumn('link','string',['default' => null, 'null' => true]);
     $table->create();
    }

    public function down() {

    }
}
