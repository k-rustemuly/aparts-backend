<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        City::create(
            [
                'region_id' => 1,
                'name_kk' => 'Ақтау қ.',
                'name_ru' => 'г. Актау',
            ]
        );
        City::create(
            [
                'region_id' => 1,
                'name_kk' => 'Жаңаөзен қ.',
                'name_ru' => 'г. Жанаозен',
            ]
        );
    }
}
