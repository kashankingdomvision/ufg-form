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



        // $data = [ 
        //     [   
        //         'code'        => 'PC-0001',
        //         'name'        => Str::random(4),
        //         'description' => Str::random(55),
        //         'created_at'  => now(),
        //         'updated_at'  => now()
        //     ],
        //     [   
        //         'code'        => 'PC-0002',
        //         'name'        => Str::random(4),
        //         'description' => Str::random(55),
        //         'created_at'  => now(),
        //         'updated_at'  => now()
        //     ],
        // ];
        
        // Product::insert($data);
    }
    
   
}
