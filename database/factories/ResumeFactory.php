<?php declare(strict_types=1);
namespace Database\Factories;

use App\Models\City;
use App\Models\Country;
use App\Models\Language;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Resume>
 */
class ResumeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'profession' => fake()->jobTitle,
            'surname' => fake()->lastName,
            'name' => fake()->firstName,
            'birthdate' => Carbon::parse('2005-06-14')->format('Y-m-d'),
            'salary' => 100000,
            'have_car' => false,
            'about_me' => fake()->sentence,
            'phone' => fake()->phoneNumber,
            'email' => fake()->safeEmail,
            'preferred_contact' => 'phone',
            'gender' => 'male',
            'ready_to_move' => 'want',
            'business_trips' => 'ready',
            'occupation' => 'full-time',
            'schedule' => 'full',
            'travel_time' => 'dontcare',
            'main_language_id' => Language::factory(),
            'city_id' => City::factory(),
            'citizenship_country_id' => Country::factory(),
            'work_permit_country_id' => Country::factory(),
            'user_id' => User::factory()
        ];
    }
}
