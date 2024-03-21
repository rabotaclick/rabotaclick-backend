<?php declare(strict_types=1);
namespace Database\Factories;

use App\Models\Subspecialization;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profession>
 */
class ProfessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->title,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
