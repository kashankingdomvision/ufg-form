<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $sql = file_get_contents(database_path() . '/seeds/sql_dump/products.sql');
        DB::unprepared($sql);

        /* dummy product for transfer category */ 
        $transfer_products = [ 
            [
                'code'             => 'PA',
                'name'             => 'PIA Airline',
                'category_id'      => 1,
                'country_id'       => NULL,
                'location_id'      => 1,
                'currency_id'      => NULL,
                'booking_type_id'  => 1,
                'duration'         => NULL,
                'price'            => NULL,
                'description'      => NULL,
                'inclusions'       => NULL,
                'packing_list'     => NULL,
                'created_at'       => now(),
                'updated_at'       => now(),
            ]
        ];

        /* dummy product for cruise category */ 
        $cruise_products = [ 
            [
                'code'             => 'SD-Cruise',
                'name'             => 'Signature Split to Dubrovnik Cruise',
                'category_id'      => 4,
                'country_id'       => NULL,
                'location_id'      => 1,
                'currency_id'      => NULL,
                'booking_type_id'  => 1,
                'duration'         => NULL,
                'price'            => NULL,
                'description'      => NULL,
                'inclusions'       => NULL,
                'packing_list'     => NULL,
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'code'             => 'DS-Cruise',
                'name'             => 'Deluxe Dubrovnik to Split Cruise',
                'category_id'      => 4,
                'country_id'       => NULL,
                'location_id'      => 1,
                'currency_id'      => NULL,
                'booking_type_id'  => 1,
                'duration'         => NULL,
                'price'            => NULL,
                'description'      => NULL,
                'inclusions'       => NULL,
                'packing_list'     => NULL,
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'code'             => 'NDD-Cruise',
                'name'             => 'Northern Dalmatia Deluxe Cruise',
                'category_id'      => 4,
                'country_id'       => NULL,
                'location_id'      => 1,
                'currency_id'      => NULL,
                'booking_type_id'  => 1,
                'duration'         => NULL,
                'price'            => NULL,
                'description'      => NULL,
                'inclusions'       => NULL,
                'packing_list'     => NULL,
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
        ];
        
        Product::insert($cruise_products);
        Product::insert($transfer_products);

    }
   
}
