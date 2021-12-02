<?php

use Illuminate\Database\Seeder;

class AllCurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = file_get_contents(database_path() . '/seeds/sql_dump/all_currencies.sql');
        DB::statement($sql);
    }
}
