<?php

use Illuminate\Database\Seeder;
use App\Season;
class SeasonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $season =  [
            [
                'name'          => '2021-2022',
                'start_date'    =>  date('Y-m-d', strtotime('2021-02-03')),
                'end_date'      => date('Y-m-d', strtotime('2022-06-05')),
                'default'       =>  '1',
            ],
            
            [
                'name'          => '2020-2021',
                'start_date'    =>  date('Y-m-d', strtotime('2020-03-06')),
                'end_date'      => date('Y-m-d', strtotime('2021-04-08')),
                'default'       =>  '0',
            ],
        ];
        
        Season::insert($season);
    }
}
