<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Specialization;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => 'individual',
            'name' => $this->faker->company,
            'website' => $this->faker->url,
            'phone' => $this->faker->phoneNumber,
            'description' => $this->faker->sentence,
            'city_id' => City::factory(),
            'specialization_id' => Specialization::factory()
        ];
    }
}
