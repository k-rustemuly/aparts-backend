<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use MoonShine\Models\MoonshineUser;

class MoonshineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MoonshineUser::create(
            [
                'name' => 'Kuanysh',
                'email' => 'kuanish@mail.kz',
                'password' => Hash::make(env('MOONSHINE_ADMIN_PASSWORD', '123456')),
            ]
        );
    }
}
