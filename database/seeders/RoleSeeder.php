<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            "name_kk" => "Қолданушы",
            "name_ru" => "Пользователь"
        ]);

        Role::create([
            "name_kk" => "Директор",
            "name_ru" => "Директор"
        ]);

        Role::create([
            "name_kk" => "Әкімші",
            "name_ru" => "Администратор"
        ]);

        Role::create([
            "name_kk" => "Сатылым бойынша менеджер",
            "name_ru" => "Менеджер продаж"
        ]);

        Role::create([
            "name_kk" => "Бухгалтер",
            "name_ru" => "Бухгалтер"
        ]);

        Role::create([
            "name_kk" => "Кассир",
            "name_ru" => "Кассир"
        ]);

        Role::create([
            "name_kk" => "Регистратура",
            "name_ru" => "Регистратура"
        ]);
    }
}

