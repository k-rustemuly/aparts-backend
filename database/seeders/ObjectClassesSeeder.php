<?php

namespace Database\Seeders;

use App\Models\ObjectClass;
use Buildit\Enum\Color;
use Illuminate\Database\Seeder;

class ObjectClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ObjectClass::create(
            [
                'name_kk' => 'I класс (Элиталық)',
                'name_ru' => 'I класс (Элит)',
                'style' => Color::SUCCESS,
            ]
        );
        ObjectClass::create(
            [
                'name_kk' => 'II класс (Бизнес)',
                'name_ru' => 'II класс (Бизнес)',
                'style' => Color::INFO,
            ]
        );
        ObjectClass::create(
            [
                'name_kk' => 'III класс (Комфорт)',
                'name_ru' => 'III класс (Комфорт)',
                'style' => Color::WARNING,
            ]
        );
        ObjectClass::create(
            [
                'name_kk' => 'IV класс (Эконом)',
                'name_ru' => 'IV класс (Эконом)',
                'style' => Color::ERROR,
            ]
        );
    }
}
