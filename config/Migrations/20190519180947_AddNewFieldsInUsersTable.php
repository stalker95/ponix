<?php
use Migrations\AbstractMigration;

class AddNewFieldsInUsersTable extends AbstractMigration
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
        $table = $this->table('users');
        $table->addColumn('address', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('city', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('zone', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('phone', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('business', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->save();
    }
    public function down() {

    }
}
