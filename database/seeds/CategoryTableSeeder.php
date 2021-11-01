<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Transfer', 'Accommodation', 'Tour', 'Cruise', 'Taxes', 'Service Excursion','Ferry / Catamaran','Train', 'Flights','Misc.'];
        foreach ($categories as $category) {
            Category::create([

                'name' => $category, 
                'slug' => Str::slug($category)
            ]);
        }
    }
}
