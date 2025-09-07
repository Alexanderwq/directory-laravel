<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Category;

class CompanyCategoriesSeeder extends Seeder
{
    public function run(): void
    {
        $companies = Company::all();
        $categories = Category::all();

        foreach ($companies as $company) {
            $randomCategories = $categories->random(rand(1, 3))->pluck('id');
            $company->categories()->sync($randomCategories);
        }
    }
}
