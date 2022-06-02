<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'dni' => $this->faker->unique()->dni(),
            'nombre' => $this->faker->firstName() . " " . $this->faker->lastName(),
            'fnacimiento' => $this->faker->dateTimeBetween('-40 years', 'now'),
        ];
    }
}
