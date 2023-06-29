<?php

namespace Database\Seeders;

use App\Models\CommercialPremise;
use Illuminate\Database\Seeder;

class CommercialPremiseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CommercialPremise::create([
            'object_id' => 1,
            'block_id' => 1,
            'floor' => 1,
            'number' => 1,
            'area' => '78.15',
            'ceiling_height' => '5.0',
            'finishing_status_id' => 1,
        ]);
    }
}
