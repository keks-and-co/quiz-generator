<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * table name => seeder class
     * or
     * seeder class
     *
     * @var array
     */
    protected $seeders = [
        'administr_languages'   => LanguagesTableSeeder::class,
        'users'                 => UsersSeeder::class,
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        foreach ($this->seeders as $table => $seeder) {
            if (is_string($table)) {
                DB::table($table)->truncate();
            }

            $this->call($seeder);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}