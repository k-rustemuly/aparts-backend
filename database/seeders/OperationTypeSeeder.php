<?php

namespace Database\Seeders;

use App\Models\OperationType;
use Illuminate\Database\Seeder;

class OperationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OperationType::create([
            'name_kk' => 'Алдын ала төлем',
            'name_ru' => 'Предоплата'
        ]);

        OperationType::create([
            'name_kk' => 'Басқасы',
            'name_ru' => 'Другое'
        ]);
    }
}
