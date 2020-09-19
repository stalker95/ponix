<?php
use Migrations\AbstractMigration;

class CreateFaqTabel extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function up() {
     $table=$this->table('faq');
     $table->addColumn('tile','string',['default' => null, 'null' => true]);
     $table->addColumn('description','string',['default' => null, 'null' => true]);
     $table->create();
    }

    public function down() {

    }
}
