<?php

use Illuminate\Database\Seeder;
use App\Station;

class StationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stations = ['Great Eastern Main Line Lea Valley Lines', 'Brighton Main Line Chatham Main Line', 'South Eastern Main Line Brighton Main Line Thameslink', 'South West Main Line West of England Main Line'];

        foreach ($stations as $station) {

            Station::create([
                'name' => $station,
            ]);
        }
    }
}
