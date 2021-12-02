<?php

use Illuminate\Database\Seeder;

class SupplierProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = file_get_contents(database_path() . '/seeds/sql_dump/supplier_products.sql');
        DB::unprepared($sql);
    }
}
