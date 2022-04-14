<?php

use Illuminate\Database\Seeder;

class StoreTextTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = file_get_contents(database_path() . '/seeds/sql_dump/store_texts.sql');
        DB::unprepared($sql);
    }
}
