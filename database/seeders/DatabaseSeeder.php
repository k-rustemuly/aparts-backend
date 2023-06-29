<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            MoonshineSeeder::class,
            ConstructionTechnologiesSeeder::class,
            ObjectClassesSeeder::class,
            ObjectStatusesSeeder::class,
            RegionsSeeder::class,
            CitiesSeeder::class,
            HeatingTypesSeeder::class,
            ParkingStatusSeeder::class,
            StoreroomStatusSeeder::class,
            ObjectSeeder::class,
            BlockSeeder::class,
            ParkingSeeder::class,
            CommercialPremiseStatusSeeder::class,
            FinishingStatusSeeder::class,
            CommercialPremiseSeeder::class,
            StoreroomSeeder::class,
            FlatStatusSeeder::class,
            BankSeeder::class,
            OperationTypeSeeder::class,
            ClientSeeder::class,
            TransactionStatusSeeder::class,
            FlatSeeder::class,
            TransactionSeeder::class
        ]);
    }
}
