<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(
            [
                'name' => 'Kuanysh',
                'email' => 'kuanish@mail.kz',
                'role_id' => 3,
                'password' => Hash::make('123456'),
            ]
        );
        User::create(
            [
                'name' => 'Kuanysh Director',
                'email' => 'kuanish1@mail.kz',
                'role_id' => 2,
                'password' => Hash::make('123456'),
            ]
        );
        User::create(
            [
                'name' => 'Kuanysh Prodazh',
                'email' => 'kuanish2@mail.kz',
                'role_id' => 4,
                'password' => Hash::make('123456'),
            ]
        );
        User::create(
            [
                'name' => 'Kuanysh Buh',
                'email' => 'kuanish3@mail.kz',
                'role_id' => 5,
                'password' => Hash::make('123456'),
            ]
        );
        User::create(
            [
                'name' => 'Kuanysh Kassir',
                'email' => 'kuanish4@mail.kz',
                'role_id' => 6,
                'password' => Hash::make('123456'),
            ]
        );
        User::create(
            [
                'name' => 'Kuanysh Register',
                'email' => 'kuanish5@mail.kz',
                'role_id' => 7,
                'password' => Hash::make('123456'),
            ]
        );
    }
}
