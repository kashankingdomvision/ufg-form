<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $sql = file_get_contents(database_path() . '/seeds/sql_dump/users.sql');
        DB::unprepared($sql);

        // $users = [
        //     [
        //         'role_id'             =>  1,
        //         'supervisor_id'       =>  NULL,
        //         'currency_id'         =>  1,
        //         'brand_id'            =>  1,
        //         'holiday_type_id'     =>  1,
        //         'commission_id'       =>  1,
        //         'commission_group_id' =>  1,
        //         'supplier_currency_id'=>  2,
        //         'name'                =>  'Kashan',
        //         'email'               =>  'kashan.kingdomvision@gmail.com',
        //         'email_verified_at'   =>  now(),
        //         'password'            =>  Hash::make(12345678),
        //         'created_at'          =>  now(),
        //         'updated_at'          =>  now()
        //     ],

        //     [
        //         'role_id'             =>  2,
        //         'supervisor_id'       =>  NULL,
        //         'currency_id'         =>  1,
        //         'brand_id'            =>  1,
        //         'holiday_type_id'     =>  1,
        //         'commission_id'       =>  1,
        //         'commission_group_id' =>  1,
        //         'supplier_currency_id'=>  NULL,
        //         'name'                =>  'Muno Mandizha',
        //         'email'               =>  'muno.mandizha@gmail.com',
        //         'email_verified_at'   =>  now(),
        //         'password'            =>  Hash::make(12345678),
        //         'created_at'          =>  now(),
        //         'updated_at'          =>  now()
        //     ],

        //     [
        //         'role_id'             =>  2,
        //         'supervisor_id'       =>  NULL,
        //         'currency_id'         =>  1,
        //         'brand_id'            =>  1,
        //         'holiday_type_id'     =>  1,
        //         'commission_id'       =>  1,
        //         'commission_group_id' =>  1,
        //         'supplier_currency_id'=>  NULL,
        //         'name'                =>  'Pietro Molica Lazzaro',
        //         'email'               =>  'pietro.molica.lazzaro@gmail.com',
        //         'email_verified_at'   =>  now(),
        //         'password'            =>  Hash::make(12345678),
        //         'created_at'          =>  now(),
        //         'updated_at'          =>  now()
        //     ],

        //     [
        //         'role_id'             =>  2,
        //         'supervisor_id'       =>  NULL,
        //         'currency_id'         =>  1,
        //         'brand_id'            =>  1,
        //         'holiday_type_id'     =>  1,
        //         'commission_id'       =>  1,
        //         'commission_group_id' =>  1,
        //         'supplier_currency_id'=>  NULL,
        //         'name'                =>  'Natalie Jurcic',
        //         'email'               =>  'natalie.jurcic@gmail.com',
        //         'email_verified_at'   =>  now(),
        //         'password'            =>  Hash::make(12345678),
        //         'created_at'          =>  now(),
        //         'updated_at'          =>  now()
        //     ],

        //     [
        //         'role_id'             =>  2,
        //         'supervisor_id'       =>  NULL,
        //         'currency_id'         =>  1,
        //         'brand_id'            =>  1,
        //         'holiday_type_id'     =>  1,
        //         'commission_id'       =>  1,
        //         'commission_group_id' =>  1,
        //         'supplier_currency_id'=>  NULL,
        //         'name'                =>  'Perian Johnson',
        //         'email'               =>  'perian.johnson@gmail.com',
        //         'email_verified_at'   =>  now(),
        //         'password'            =>  Hash::make(12345678),
        //         'created_at'          =>  now(),
        //         'updated_at'          =>  now()
        //     ],

        //     [
        //         'role_id'             =>  2,
        //         'supervisor_id'       =>  NULL,
        //         'currency_id'         =>  1,
        //         'brand_id'            =>  1,
        //         'holiday_type_id'     =>  1,
        //         'commission_id'       =>  1,
        //         'commission_group_id' =>  1,
        //         'supplier_currency_id'=>  NULL,
        //         'name'                =>  'Ally Lewing',
        //         // 'email'               =>  'Ally.Lewing@gmail.com',
        //         'email'               =>  'allyl@unforgettabletravelcompany.com',
        //         'email_verified_at'   =>  now(),
        //         'password'            =>  Hash::make(12345678),
        //         'created_at'          =>  now(),
        //         'updated_at'          =>  now()
        //     ],

        //     [
        //         'role_id'             =>  2,
        //         'supervisor_id'       =>  NULL,
        //         'currency_id'         =>  1,
        //         'brand_id'            =>  1,
        //         'holiday_type_id'     =>  1,
        //         'commission_id'       =>  1,
        //         'commission_group_id' =>  1,
        //         'supplier_currency_id'=>  NULL,
        //         'name'                =>  'Luke Stapylton-Smith',
        //         'email'               =>  'luke.stapylton-smith@gmail.com',
        //         'email_verified_at'   =>  now(),
        //         'password'            =>  Hash::make(12345678),
        //         'created_at'          =>  now(),
        //         'updated_at'          =>  now()
        //     ],

            
        //     [
        //         'role_id'             =>  2,
        //         'supervisor_id'       =>  NULL,
        //         'currency_id'         =>  1,
        //         'brand_id'            =>  1,
        //         'holiday_type_id'     =>  1,
        //         'commission_id'       =>  1,
        //         'commission_group_id' =>  1,
        //         'supplier_currency_id'=>  NULL,
        //         'name'                =>  'Gemma D’Souza',
        //         'email'               =>  'gemma.d’souza@gmail.com',
        //         'email_verified_at'   =>  now(),
        //         'password'            =>  Hash::make(12345678),
        //         'created_at'          =>  now(),
        //         'updated_at'          =>  now()
        //     ],

        //     [
        //         'role_id'             =>  2,
        //         'supervisor_id'       =>  NULL,
        //         'currency_id'         =>  1,
        //         'brand_id'            =>  1,
        //         'holiday_type_id'     =>  1,
        //         'commission_id'       =>  1,
        //         'commission_group_id' =>  1,
        //         'supplier_currency_id'=>  NULL,
        //         'name'                =>  'Nora Frohberg',
        //         'email'               =>  'nora.frohberg@gmail.com',
        //         'email_verified_at'   =>  now(),
        //         'password'            =>  Hash::make(12345678),
        //         'created_at'          =>  now(),
        //         'updated_at'          =>  now()
        //     ],

        //     [
        //         'role_id'             =>  2,
        //         'supervisor_id'       =>  NULL,
        //         'currency_id'         =>  1,
        //         'brand_id'            =>  1,
        //         'holiday_type_id'     =>  1,
        //         'commission_id'       =>  1,
        //         'commission_group_id' =>  1,
        //         'supplier_currency_id'=>  NULL,
        //         'name'                =>  'Graham Carter',
        //         'email'               =>  'graham.carter@gmail.com',
        //         'email_verified_at'   =>  now(),
        //         'password'            =>  Hash::make(12345678),
        //         'created_at'          =>  now(),
        //         'updated_at'          =>  now()
        //     ],
        // ];

        // User::insert($users);
    }
}

// [
//     'role_id'             =>  5,
//     'supervisor_id'       =>  NULL,
//     'currency_id'         =>  2,
//     'brand_id'            =>  1,
//     'holiday_type_id'     =>  1,
//     'commission_id'       =>  1,
//     'commission_group_id' =>  2,
//     'name'                =>  'Tabseer',
//     'email'               =>  'tabseer@gmail.com',
//     'email_verified_at'   =>  now(),
//     'password'            =>  Hash::make(12345678),
//     'created_at'          =>  now(),
//     'updated_at'          =>  now()
// ],

// [
//     'role_id'              =>  2,
//     'supervisor_id'        =>  2,
//     'currency_id'          =>  3,
//     'commission_id'        =>  NULL,
//     'commission_group_id'  =>  NULL,
//     'brand_id'             =>  1,
//     'holiday_type_id'      =>  1,
//     'name'                 =>  'Muhammad Tabraiz',
//     'email'                =>  'm.tabraizbukhari@gmail.com',
//     'email_verified_at'    =>  now(),
//     'password'             =>  Hash::make(12345678),
//     'created_at'           =>  now(),
//     'updated_at'           =>  now()
// ],

// [
//     'role_id'             =>  6,
//     'supervisor_id'       =>  null,
//     'currency_id'         =>  3,
//     'commission_id'       =>  NULL,
//     'commission_group_id' =>  NULL,
//     'brand_id'            =>  1,
//     'holiday_type_id'     =>  1,
//     'name'                =>  'louis Fonsi',
//     'email'               =>  'louisfonis@gmail.com',
//     'email_verified_at'   =>  now(),
//     'password'            =>  Hash::make(12345678),
//     'created_at'          =>  now(),
//     'updated_at'          =>  now()
// ],