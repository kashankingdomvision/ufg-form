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
                'name'           => 'Red',
                'created_at'     =>  now(),
                'updated_at'     =>  now()
            ],
            [
                'name'           => 'Green',
                'created_at'     =>  now(),
                'updated_at'     =>  now()
            ]
        ];

        CommissionGroup::insert($commission_groups);
    }
}

