<?php
use Migrations\AbstractMigration;

class AddColumnUserIdMediaTable extends AbstractMigration
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
        $table = $this->table('media');
        $table->addColumn('user_id', 'string', [
            'default' => null,
            'null' => true,
        ]);
        
        $table->save();
    }
    public function down() {

    }
}
