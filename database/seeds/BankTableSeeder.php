<?php

use Illuminate\Database\Seeder;
use App\Bank;

class BankTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $banks = ['Capital Bank','Chase Bank'];

        $banks = [
            [   
                'name' => 'Capital Bank',
                'created_at' =>  now(),
                'updated_at' =>  now()
            ],

            [
                'name' => 'Chase Bank',
                'created_at' =>  now(),
                'updated_at' =>  now()

            ],
        ];

        Bank::insert($banks);
    }
}
