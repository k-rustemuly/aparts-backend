<?php

namespace Database\Seeders;

use App\Models\CashDeskOperation;
use Illuminate\Database\Seeder;

class CashDeskOperationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CashDeskOperation::create(
            [
                'number' => 'A12345',
                'money' => '120000.00',
            ]
        );
    }
}
