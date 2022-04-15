<?php

use Illuminate\Database\Seeder;

class BrandSupplierCountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = file_get_contents(database_path() . '/seeds/sql_dump/brand_supplier_countries.sql');
        DB::statement($sql);
    }
}
