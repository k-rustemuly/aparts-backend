<?php

namespace Database\Seeders;

use App\Models\HeatingType;
use Buildit\Enum\Color;
use Illuminate\Database\Seeder;

class HeatingTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HeatingType::create(
            [
                'name_kk' => 'Орталық',
                'name_ru' => 'Центральное',
                'style' => Color::SUCCESS,
            ]
        );
        HeatingType::create(
            [
                'name_kk' => 'Автономды',
                'name_ru' => 'Автономное',
                'style' => Color::INFO,
            ]
        );
    }
}
//php artisan db:seed --class=HeatingTypesSeeder
