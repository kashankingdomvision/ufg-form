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
        // $categories = ['Transfer', 'Accommodation', 'Tours', 'Cruise', 'Taxes', 'Service Excursion','Ferry / Catamaran','Train', 'Flights','Misc.','Airline'];
        $categories = ['Transfer', 'Accommodation', 'Tours', 'Cruise', 'Taxes', 'Ferry / Catamaran','Train', 'Flights','Misc.'];
        foreach ($categories as $key => $category) {
            $category = Category::create([

                'name'       => $category, 
                'slug'       => Str::slug($category),
                'sort_order' => $key+1,
            ]);
        }

        Category::where('id', 1)->update([ 'set_end_date_of_service' => '1' ]);
    }
}
