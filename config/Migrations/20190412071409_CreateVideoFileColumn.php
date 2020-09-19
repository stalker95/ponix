<?php
use Migrations\AbstractMigration;

class CreateVideoFileColumn extends AbstractMigration
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
        $table->addColumn('video', 'string', ['default' => 0,'null' => false]);
        $table->save();
    }

    public function down() {
        
    }
}
