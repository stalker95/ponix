<?php
use Migrations\AbstractMigration;

class TablePlayList extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
     public function up() {
     $table=$this->table('playlists');
     $table->addColumn('name','string',['default' => null, 'null' => true]);
     $table->addColumn('user_id','integer',['default' => null, 'null' => true]);
     $table->addColumn('category_id', 'integer', ['default' => null, 'null' => true]);
     $table->addColumn('city','string',['default' => null, 'null' => true]);
     $table->addColumn('region','string',['default' => null, 'null' => true]);
     $table->addColumn('time','integer',['default' => null, 'null' => true]);
     $table->addColumn('created', 'datetime', ['default' => null, 'null' => true]);
     $table->addColumn('modified', 'datetime', ['default' => null, 'null' => true]);
     $table->create();
    }

    public function down() {

    }
}
