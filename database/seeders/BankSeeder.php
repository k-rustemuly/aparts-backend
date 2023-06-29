<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bank::create(
            [
                'name_kk' => 'Қазақстан Халық Банкі',
                'name_ru' => 'Народный банк Казахстана',
            ]
        );
        Bank::create(
            [
                'name_kk' => 'Bereke Bank',
                'name_ru' => 'Bereke Bank',
            ]
        );
        Bank::create(
            [
                'name_kk' => 'Kaspi Bank',
                'name_ru' => 'Kaspi Bank',
            ]
        );
        Bank::create(
            [
                'name_kk' => 'Отбасы банк',
                'name_ru' => 'Отбасы банк',
            ]
        );
        Bank::create(
            [
                'name_kk' => 'Jusan Bank',
                'name_ru' => 'Jusan Bank',
            ]
        );
        Bank::create(
            [
                'name_kk' => 'ForteBank',
                'name_ru' => 'ForteBank',
            ]
        );
        Bank::create(
            [
                'name_kk' => 'Еуразиялық банк',
                'name_ru' => 'Евразийский банк',
            ]
        );
        Bank::create(
            [
                'name_kk' => 'Фридом Финанс',
                'name_ru' => 'Фридом Финанс',
            ]
        );
        Bank::create(
            [
                'name_kk' => 'Home Credit Bank',
                'name_ru' => 'Home Credit Bank',
            ]
        );
    }
}
