<?php

namespace Database\Factories;

use App\Models\School;
use Faker\Provider\it_IT\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $school = School::all();

        return [
            'school_id' => fake()->numberBetween(1, $school->count()),
            'photo' => fake()->imageUrl(245, 245, 'persons', true, 'fototessera', false, 'jpg'),
            'name' => fake()->name(),
            'lastName' => fake()->lastName(),
            'sex' => fake()->randomElement(['uomo', 'donna']),
            'date_of_birth' => fake()->date(),
            'birth_place' => fake()->city(),
            'country_of_birth' => fake()->country(),
            'address' => fake()->address(),
            'civic' => fake()->numberBetween(1, 500),
            'postcode' => fake()->postcode(),
            'fiscal_code' => Person::taxId(),
            'country' => fake()->country(),
            'email' => fake()->unique()->safeEmail(),
        ];
    }
}
