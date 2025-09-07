<?php

namespace Database\Seeders;

use App\Models\Building;
use Illuminate\Database\Seeder;
use App\Models\Company;

class CompaniesTableSeeder extends Seeder
{
    public function run(): void
    {
        $companyNames = [
            'ООО "Рога и Копыта"',
            'ООО "Свет и Тень"',
            'ЗАО "Техника Плюс"',
            'ИП "Новые Идеи"',
            'ООО "Вектор"',
        ];

        $buildings = Building::all();

        foreach ($companyNames as $name) {
            Company::factory()->create([
                'name' => $name,
                'building_id' => $buildings->random()->id,
                'office_number' => fake()->numberBetween(1, 500),
            ]);
        }
    }
}
