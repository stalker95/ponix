<?php
use Migrations\AbstractMigration;

class PlaylistCategoryTable extends AbstractMigration
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
        $table = $this->table('playlists_categories');
        $table->addColumn('playlist_id', 'integer', ['null' => false]);
        $table->addColumn('category_id', 'integer', ['null' => false]);
        $table->save();
    }

    public function down() {
        
    }
}
