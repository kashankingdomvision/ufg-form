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
                'name'                 => 'Cruise',
                // 'percentage'           =>  1,
                // 'commission_group_id'  =>  1,
                // 'brand_id'             =>  1,
                // 'holiday_type_id'      =>  1,
                // 'currency_id'          =>  1,
                'created_at'           =>  now(),
                'updated_at'           =>  now()
            ],
         
        ];

        Commission::insert($commision_types);
    }
}
