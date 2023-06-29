<?php

namespace Database\Seeders;

use App\Models\ObjectStatus;
use Buildit\Enum\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ObjectStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ObjectStatus::create(
            [
                'name_kk' => 'Жоба',
                'name_ru' => 'Черновик',
                'style' => Color::INFO,
            ]
        );
        ObjectStatus::create(
            [
                'name_kk' => 'Жарияланды',
                'name_ru' => 'Опубликовано',
                'style' => Color::SUCCESS,
            ]
        );
        ObjectStatus::create(
            [
                'name_kk' => 'Жасырын',
                'name_ru' => 'Скрыто',
                'style' => Color::WARNING,
            ]
        );
        ObjectStatus::create(
            [
                'name_kk' => 'Жойылған',
                'name_ru' => 'Удалено',
                'style' => Color::ERROR,
            ]
        );
    }
}
