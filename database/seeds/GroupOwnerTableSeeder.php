<?php

use Illuminate\Database\Seeder;

class GroupOwnerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = file_get_contents(database_path() . '/seeds/sql_dump/group_owners.sql');
        DB::unprepared($sql);
    }
}
