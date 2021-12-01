<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InitialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = file_get_contents(database_path() . '/seeds/sql_dump/currencies.sql');
        DB::statement($sql);
        
        $sql = file_get_contents(database_path() . '/seeds/sql_dump/hotels.sql');
        DB::statement($sql);

        $sql = file_get_contents(database_path() . '/seeds/sql_dump/airport_codes.sql');
        DB::statement($sql);

        $sql = file_get_contents(database_path() . '/seeds/sql_dump/harbours.sql');
        DB::statement($sql);

        $sql = file_get_contents(database_path() . '/seeds/sql_dump/group_owners.sql');
        DB::unprepared($sql);
    }
}
