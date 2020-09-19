<?php
use Migrations\AbstractMigration;

class TablePlaylistsMedia extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function up() {
     $table=$this->table('playlists_media');
     $table->addColumn('playlist_id','integer',['default' => null, 'null' => true]);
     $table->addColumn('media_id','integer',['default' => null, 'null' => true]);
     $table->addColumn('rank','integer',['default' => null, 'null' => true]);
     $table->create();
    }

    public function down() {

    }
}
