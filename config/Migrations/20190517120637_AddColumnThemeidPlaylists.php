<?php
use Migrations\AbstractMigration;

class AddColumnThemeidPlaylists extends AbstractMigration
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
     $table->addColumn('theme_id','integer',['default' => null, 'null' => true]);
     $table->save();
    }

    public function down() {

    }
}
