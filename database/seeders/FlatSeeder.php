<?php

namespace Database\Seeders;

use App\Models\Flat;
use Illuminate\Database\Seeder;

class FlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Flat::create([
            'object_id' => 1,
            'block_id' => 1,
            'floor' => 1,
            'number' => 1,
            'area' => '135.00',
            'ceiling_height' => '3.2',
            'room' => 3,
            'price' => '350000.00',
        ]);
    }
}
