<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transaction::withoutEvents(function () {
            Transaction::create([
                'client_id' => 1,
                'operation_type_id' => 1,
                'status_id' => 2,
                'sum' => '120000.00',
                'employee_id' => 5,
            ]);
        });
    }
}
