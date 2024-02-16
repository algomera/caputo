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
        $schools = School::all();

        return [
            'school_id' => $schools->random()->id,
            'name' => fake()->name(),
            'lastName' => fake()->lastName(),
            'sex' => fake()->randomElement(['uomo', 'donna']),
            //birth
            'date_of_birth' => fake()->date(),
            'birth_place' => fake()->city(),
            'country_of_birth' => fake()->regexify('[A-Z]{2}'),
            //Residences
            'city' => fake()->city(),
            'province' => fake()->regexify('[A-Z]{2}'),
            'postcode' => fake()->postcode(),
            'toponym' => fake()->word(),
            'address' => fake()->address(),
            'civic' => fake()->numberBetween(1, 500),
            'fiscal_code' => Person::taxId(),
            'country' => fake()->country(),
            'email' => fake()->unique()->safeEmail(),
            'phone_1' => fake()->phoneNumber(),
            'phone_2' => fake()->phoneNumber(),

        ];
    }
}
