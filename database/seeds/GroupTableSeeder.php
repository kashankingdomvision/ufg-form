<?php

use Illuminate\Database\Seeder;
use App\Group;

class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group_types  = [
            [
                'name'       => 'ABC',
                'created_at' =>  now(),
                'updated_at' =>  now()
            ],
            [ 
                'name'       => 'XYZ',
                'created_at' =>  now(),
                'updated_at' =>  now()
            ],
        ];

        Group::insert($group_types);
    }
}
