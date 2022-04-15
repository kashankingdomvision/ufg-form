<?php

use Illuminate\Database\Seeder;
use App\CommissionCriteria;
use App\CommissionCriteriaSeason;

class CommissionCriteriaSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $sql = file_get_contents(database_path() . '/seeds/sql_dump/commission_criterias.sql');
        // DB::unprepared($sql);

        // $sql = file_get_contents(database_path() . '/seeds/sql_dump/commission_criteria_groups.sql');
        // DB::unprepared($sql);

        // $sql = file_get_contents(database_path() . '/seeds/sql_dump/commission_criteria_brands.sql');
        // DB::unprepared($sql);

        // $sql = file_get_contents(database_path() . '/seeds/sql_dump/commission_criteria_holiday_types.sql');
        // DB::unprepared($sql);

        // $sql = file_get_contents(database_path() . '/seeds/sql_dump/commission_criteria_currencies.sql');
        // DB::unprepared($sql);

        // $sql = file_get_contents(database_path() . '/seeds/sql_dump/commission_criteria_seasons.sql');
        // DB::unprepared($sql);
        
        // $commission_criteria  = [
        //     [
        //         'commission_id'       => 1,
        //         'percentage'          => 10,
        //         // 'commission_group_id' => 1,
        //         // 'brand_id'            => 1,
        //         // 'holiday_type_id'     => 1,
        //         // 'currency_id'         => 1,
        //         'user_id'             => 1,
        //         'created_at'          => now(),
        //         'updated_at'          => now()
        //     ],
        //     [
        //         'commission_id'       => 1,
        //         'percentage'          => 20,
        //         // 'commission_group_id' => 2,
        //         // 'brand_id'            => 4,
        //         // 'holiday_type_id'     => 23,
        //         // 'currency_id'         => 1,
        //         'user_id'             => 1,
        //         'created_at'          => now(),
        //         'updated_at'          => now()
        //     ],
   
        // ];

        // $commission_criteria_seasons  = [
        //     [
        //         'season_id'              => 1,
        //         'commission_criteria_id' => 1,
        //         'created_at'          => now(),
        //         'updated_at'          => now()
        //     ],
        //     [
        //         'season_id'              => 1,
        //         'commission_criteria_id' => 2,
        //         'created_at'          => now(),
        //         'updated_at'          => now()
        //     ]
          
        // ];

        // CommissionCriteria::insert($commission_criteria);
        // CommissionCriteriaSeason::insert($commission_criteria_seasons);
    }
}
