<?php

use Illuminate\Database\Seeder;

class HarbourTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = file_get_contents(database_path() . '/seeds/sql_dump/harbours.sql');
        DB::statement($sql);
    }
}
