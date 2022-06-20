<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\school>
 */
class SchoolFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word().' High School',
            'address_1' => $this->faker->address(),
            'address_2' => $this->faker->address(),
            'city' => $this->faker->city(),
            'geostate_id' => rand(1,50),
            'postal_code' => $this->faker->postcode(),
            'colors' => $this->faker->colorName().','.$this->faker->colorName(),
            'student_body' => rand(1,1900),
        ];
    }
}
