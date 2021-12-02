<?php

use Illuminate\Database\Seeder;

class AirportCodeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = file_get_contents(database_path() . '/seeds/sql_dump/airport_codes.sql');
        DB::statement($sql);
    }
}
