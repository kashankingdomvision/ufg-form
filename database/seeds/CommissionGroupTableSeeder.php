<?php

use Illuminate\Database\Seeder;

use App\CommissionGroup;

class CommissionGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $commission_groups  = [
            [
                'commission_id'  => '1',
                'name'           => 'Red',
                'percentage'     => '1',
                'created_at'     =>  now(),
                'updated_at'     =>  now()
            ],
            [
                'commission_id'  => '1',
                'name'           => 'Green',
                'percentage'     => '2',
                'created_at'     =>  now(),
                'updated_at'     =>  now()
            ],
            [
                'commission_id'  => '2',
                'name'           => 'Red',
                'percentage'     => '1',
                'created_at'     =>  now(),
                'updated_at'     =>  now()
            ],
            [
                'commission_id'  => '2',
                'name'           => 'Green',
                'percentage'     => '2',
                'created_at'     =>  now(),
                'updated_at'     =>  now()
            ]
        ];

        CommissionGroup::insert($commission_groups);
    }
}

