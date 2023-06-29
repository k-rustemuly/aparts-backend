<?php

namespace Database\Seeders;

use App\Models\Objects;
use Illuminate\Database\Seeder;

class ObjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Objects::create(
            [
                'region_id' => 1,
                'city_id' => 1,
                'name_kk' => 'Алау ТҮК',
                'name_ru' => 'ЖК Алау',
                'class_id' => 1,
                'technology_id' => 1
            ]
        );
    }
}
