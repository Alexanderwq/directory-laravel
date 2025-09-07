<?php

namespace Database\Factories;

use App\Models\CompanyPhone;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Company;

class CompanyPhoneFactory extends Factory
{
    protected $model = CompanyPhone::class;

    public function definition(): array
    {
        return [
            'company_id' => Company::factory(),
            'phone' => $this->faker->numerify('+7 (###) ###-##-##'),
        ];
    }
}
