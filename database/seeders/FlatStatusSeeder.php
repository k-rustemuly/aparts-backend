<?php

namespace Database\Seeders;

use App\Models\FlatStatus;
use Buildit\Enum\Color;
use Illuminate\Database\Seeder;

class FlatStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FlatStatus::create(
            [
                'name_kk' => 'Сатылымда',
                'name_ru' => 'В продаже',
                'style' => Color::INFO,
            ]
        );
        FlatStatus::create(
            [
                'name_kk' => 'Сақталған',
                'name_ru' => 'Зарезервировано',
                'style' => Color::WARNING,
            ]
        );
        FlatStatus::create(
            [
                'name_kk' => 'Сатылды',
                'name_ru' => 'Продано',
                'style' => Color::SUCCESS,
            ]
        );
    }
}
