<?php

namespace Database\Seeders;

use App\Models\ParkingStatus;
use Buildit\Enum\Color;
use Illuminate\Database\Seeder;

class ParkingStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ParkingStatus::create(
            [
                'name_kk' => 'Сатылымда',
                'name_ru' => 'В продаже',
                'style' => Color::INFO,
            ]
        );
        ParkingStatus::create(
            [
                'name_kk' => 'Сақталған',
                'name_ru' => 'Зарезервировано',
                'style' => Color::WARNING,
            ]
        );
        ParkingStatus::create(
            [
                'name_kk' => 'Сатылды',
                'name_ru' => 'Продано',
                'style' => Color::SUCCESS,
            ]
        );
    }
}
