<?php

namespace Database\Seeders;

use App\Models\Building;
use Illuminate\Database\Seeder;

class BuildingSeeder extends Seeder
{
    public function run(): void
    {
        Building::create([
            'city' => 'Москва',
            'street' => 'ул. Ленина',
            'house_number' => '1',
            'lat' => 55.7558,
            'long' => 37.6173,
        ]);

        Building::create([
            'city' => 'Москва',
            'street' => 'ул. Ленина',
            'house_number' => '2',
            'lat' => 55.7550,
            'long' => 37.6180,
        ]);

        Building::factory(10)->create();
    }
}
