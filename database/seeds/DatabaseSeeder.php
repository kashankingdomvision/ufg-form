<?php

use Illuminate\Database\Seeder;

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
            PaymentMethodSeeder::class,
            SeasonTableSeeder::class,
            ReferenceCredentialTableSeeder::class,
            BankTableSeeder::class,
            CommissionTableSeeder::class,
            UserTableSeeder::class,
            CommissionCriteriaSeederTable::class,
            PresetCommentSeeder::class,
            CountryTableSeeder::class,
            LocationTableSeeder::class,
            ProductTableSeeder::class,
            GroupOwnerTableSeeder::class,
            SupplierTableSeeder::class,
            SupplierProductTableSeeder::class,
            AllCurrencyTableSeeder::class,
            HotelTableSeeder::class,
            AirportCodeTableSeeder::class,
            HarbourTableSeeder::class,
            CabinTypeSeeder::class,
            StationSeeder::class,
            // BrandSupplierCountryTableSeeder::class,
            TourContactTableSeeder::class,
            StoreTextTableSeeder::class,
        ]);
        // $users = factory(App\User::class, 5)->create();
    }
}
