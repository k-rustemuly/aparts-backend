<?php

namespace Database\Seeders;

use App\Models\FinishingStatus;
use Buildit\Enum\Color;
use Illuminate\Database\Seeder;

class FinishingStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FinishingStatus::create(
            [
                'name_kk' => 'Черновая',
                'name_ru' => 'Черновая',
                'style' => Color::WARNING,
            ]
        );
        FinishingStatus::create(
            [
                'name_kk' => 'Предчистовая',
                'name_ru' => 'Предчистовая',
                'style' => Color::INFO,
            ]
        );
        FinishingStatus::create(
            [
                'name_kk' => 'Чистовая',
                'name_ru' => 'Чистовая',
                'style' => Color::SUCCESS,
            ]
        );
    }
}
