<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Region::create(
            [
                'name_kk' => 'Маңғыстау облысы',
                'name_ru' => 'Мангистауская область',
            ]
        );
    }
}
