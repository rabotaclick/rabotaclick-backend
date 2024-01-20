<?php

namespace Database\Factories;

use App\Models\Region;
use App\Models\Resume;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WorkHistory>
 */
class WorkHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'organization' => fake()->company,
            'website_url' => fake()->url,
            'job' => fake()->jobTitle,
            'description' => fake()->sentence,
            'start_date' => fake()->date('Y-m-d', now()->subYears(2)),
            'end_date' => fake()->dateTimeThisYear(),
            'region_id' => Region::factory(),
            'resume_id' => Resume::factory()
        ];
    }
}
