<?php

namespace Database\Seeders;

use App\Models\TransactionStatus;
use Buildit\Enum\Color;
use Illuminate\Database\Seeder;

class TransactionStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TransactionStatus::create(
            [
                'name_kk' => 'Төленбеген',
                'name_ru' => 'Не оплачено',
                'style' => Color::ERROR,
            ]
        );
        TransactionStatus::create(
            [
                'name_kk' => 'Төленді',
                'name_ru' => 'Оплачено',
                'style' => Color::SUCCESS,
            ]
        );
        TransactionStatus::create(
            [
                'name_kk' => 'Қайтарылды',
                'name_ru' => 'Возврачено',
                'style' => Color::INFO,
            ]
        );
        TransactionStatus::create(
            [
                'name_kk' => 'Бас тартылды',
                'name_ru' => 'Отменен',
                'style' => Color::WARNING,
            ]
        );
    }
}
