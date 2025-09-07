<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\CompanyPhone;

class CompanyPhoneSeeder extends Seeder
{
    public function run(): void
    {
        $companies = Company::all();

        foreach ($companies as $company) {
            CompanyPhone::factory()->count(rand(1, 3))->create([
                'company_id' => $company->id,
            ]);
        }
    }
}

