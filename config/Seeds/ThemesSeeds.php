<?php
use Migrations\AbstractSeed;

/**
 * Users seed.
 */
class ThemesSeeds extends AbstractSeed
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
            [
              'name' => 'Red theme',
              'class' => 'red_class'
            ],
            [
              'name' => 'Blue theme',
              'class' => 'blue_class'
            ]
            
        ];

        $table = $this->table('themes');
        $table->insert($data)->save();
    }
}