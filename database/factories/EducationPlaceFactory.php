<?php declare(strict_types=1);
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EducationPlace>
 */
class EducationPlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'education' => 'master',
            'name' => fake()->name,
            'faculty' => 'faculty of math',
            'specialization' => 'IT',
            'year_of_ending' => 2030
        ];
    }
}
