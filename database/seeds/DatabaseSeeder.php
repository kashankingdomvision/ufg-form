<?php

use Illuminate\Database\Seeder;
use App\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserFactory::class);
        $this->call([
            BrandAndHolidayTableSeeder::class,
            CurrencyTableSeeder::class,
            RoleTableSeeder::class, 
            CommissionGroupTableSeeder::class,
            CategoryTableSeeder::class,
            BookingMethodSeeder::class,
            BookingTypeSeeder::class,
            CurrencyConversionSeeder::class,
            // ProductTableSeeder::class,
            PaymentMethodSeeder::class,
            SeasonTableSeeder::class,
            // SupplierTableSeeder::class,
            ReferenceCredentialTableSeeder::class,
            BankTableSeeder::class,
            CommissionTableSeeder::class,
            UserTableSeeder::class,
            CommissionCriteriaSeederTable::class,
            PresetCommentSeeder::class,
            CountryTableSeeder::class,
            LocationTableSeeder::class,
            ProductTableSeeder::class,
            SupplierTableSeeder::class,
            
            InitialTableSeeder::class,
        ]);
        // $users = factory(App\User::class, 5)->create();
    }
}
