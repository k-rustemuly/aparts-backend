<?php

namespace Database\Seeders;

use App\Models\StoreroomStatus;
use Buildit\Enum\Color;
use Illuminate\Database\Seeder;

class StoreroomStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StoreroomStatus::create(
            [
                'name_kk' => 'Сатылымда',
                'name_ru' => 'В продаже',
                'style' => Color::INFO,
            ]
        );
        StoreroomStatus::create(
            [
                'name_kk' => 'Сақталған',
                'name_ru' => 'Зарезервировано',
                'style' => Color::WARNING,
            ]
        );
        StoreroomStatus::create(
            [
                'name_kk' => 'Сатылды',
                'name_ru' => 'Продано',
                'style' => Color::SUCCESS,
            ]
        );
    }
}
