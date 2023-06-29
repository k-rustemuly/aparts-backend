<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::create(
            [
                'iin' => '960817350423',
                'phone_number' => '77782284032',
                'surname' => 'Османов',
                'name' => 'Қуаныш',
                'patronymic' => 'Рүстемұлы',
            ]
        );
    }
}
