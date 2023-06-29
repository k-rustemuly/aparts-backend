<?php

namespace Database\Seeders;

use App\Models\Block;
use Illuminate\Database\Seeder;

class BlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Block::create(
            [
                'object_id' => 1,
                'name' => 'Блок I',
                'cadastral_number' => 12,
                'storeys_number' => 10,
            ]
        );
    }
}
