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
        $data = [ 
        [   
            'code'        => Str::random(10),  
            'name'        => Str::random(4),
            'description' => Str::random(55) ],
        [   'code'        => Str::random(10),  
            'name'        => Str::random(4),
            'description' => Str::random(55) ],
        ];
        Product::insert($data);
    }
    
   
}
