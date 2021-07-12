<?php

use Illuminate\Database\Seeder;
use App\Commission;

class CommissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $commision_types  = [
            [
                'name'       => 'Cruise',
                'percentage' =>  1,
                'created_at' =>  now(),
                'updated_at' =>  now()
            ],
            [ 
                'name'       => 'Tailormade',
                'percentage' =>  1.5,
                'created_at' =>  now(),
                'updated_at' =>  now()
            ],
        ];

        Commission::insert($commision_types);
    }
}
