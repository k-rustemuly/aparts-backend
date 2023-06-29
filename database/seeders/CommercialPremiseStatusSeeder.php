<?php

namespace Database\Seeders;

use App\Models\CommercialPremiseStatus;
use Buildit\Enum\Color;
use Illuminate\Database\Seeder;

class CommercialPremiseStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CommercialPremiseStatus::create(
            [
                'name_kk' => 'Сатылымда',
                'name_ru' => 'В продаже',
                'style' => Color::INFO,
            ]
        );
        CommercialPremiseStatus::create(
            [
                'name_kk' => 'Сақталған',
                'name_ru' => 'Зарезервировано',
                'style' => Color::WARNING,
            ]
        );
        CommercialPremiseStatus::create(
            [
                'name_kk' => 'Сатылды',
                'name_ru' => 'Продано',
                'style' => Color::SUCCESS,
            ]
        );
    }
}
