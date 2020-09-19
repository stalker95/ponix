<?php
use Migrations\AbstractSeed;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'firstname' => 'testfirstname',
            'lastname'  => 'testlastname',
            'mail'      => 'test@test',
            'is_admin'  => '1',
            'active'    => '1',
            'password'  => '$2y$10$cLFShkOtjkC8UsD7SP4SMes8tvjN8GiVuycCmxwOK92p0uROcX94G',
            'created'   => date('Y-m-d H:i:s')
        ];

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}