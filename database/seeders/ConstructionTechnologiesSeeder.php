<?php

namespace Database\Seeders;

use App\Models\ConstructionTechnology;
use Buildit\Enum\Color;
use Illuminate\Database\Seeder;

class ConstructionTechnologiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ConstructionTechnology::create(
            [
                'name_kk' => 'Біртұтас каркастық',
                'name_ru' => 'Монолитно-каркасная',
                'style' => Color::SUCCESS,
            ]
        );
        ConstructionTechnology::create(
            [
                'name_kk' => 'Кірпіш',
                'name_ru' => 'Кирпичная',
                'style' => Color::INFO,
            ]
        );
    }
}
