<?php

use Illuminate\Database\Seeder;
use App\Season;

class SeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        $season = [
            [
                'name'          =>  '2020-2021',
                'start_date'    =>  date("Y-m-d"),
                'end_date'      =>  date("Y-m-d", strtotime("+1 month")),
                'default'       =>  '1',
                'created_at'    =>  now(),
                'updated_at'    =>  now(),
            ],
        ];

        Season::insert($season);
    }
}
