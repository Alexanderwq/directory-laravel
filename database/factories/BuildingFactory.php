<?php

namespace Database\Factories;

use App\Models\Building;
use Illuminate\Database\Eloquent\Factories\Factory;

class BuildingFactory extends Factory
{
    protected $model = Building::class;

    public function definition(): array
    {
        return [
            'city' => $this->faker->city(),
            'street' => $this->faker->streetName(),
            'house_number' => (string) $this->faker->buildingNumber(),
            'lat' => $this->faker->latitude(55.5, 55.9),
            'long' => $this->faker->longitude(37.3, 37.9),
        ];
    }
}
