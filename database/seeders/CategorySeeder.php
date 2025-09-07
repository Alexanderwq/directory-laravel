<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $companyNames = [
            'Еда',
            'Мясная продукция',
            'Молочная продукция',
            'Автомобили',
            'Грузовые',
            'Легковые',
            'Запчасти',
            'Аксессуары',
        ];

        foreach ($companyNames as $name) {
            Category::factory()->create([
                'name' => $name,
            ]);
        }
    }
}
