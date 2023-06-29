<?php

namespace Database\Seeders;

use App\Models\Storeroom;
use Illuminate\Database\Seeder;

class StoreroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Storeroom::generateAndSave(1, 1, 5, 15.12);
    }
}
