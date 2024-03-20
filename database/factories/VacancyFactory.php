<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vacancy>
 */
class VacancyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->jobTitle,
            'salary_from' => 100000,
            'salary_to' => 200000,
            'gpc' => false,
            'responsibilities' => $this->faker->sentence,
            'requirements' => $this->faker->sentence,
            'conditions' => $this->faker->sentence,
            'salary_type' => 'in_hand',
            'work_experience' => 'zero',
            'occupation' => 'full-time',
            'work_type' => 'full_job',
            'schedule' => 'full',
            'education' => 'high',
            'contact_name' => $this->faker->name,
            'contact_surname' => $this->faker->lastName,
            'contact_lastname' => $this->faker->firstName,
            'contact_phone' => $this->faker->phoneNumber,
            'contact_email' => $this->faker->email,
            'letter' => $this->faker->email,
            'is_active' => true,
            'city_id' => City::factory(),
            'company_id' => Company::factory()
        ];
    }
}
