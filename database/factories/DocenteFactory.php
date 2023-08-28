<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DocenteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $nombres = $this->faker->firstName(20);
        // $apellidos = $this->faker->lastName(20);

        // return [
        //     "nombres" => $nombres,
        //     "apellidos" => $apellidos
        // ];

        $nombres = [
            $this->faker->firstName,
            $this->faker->firstName
        ];

        $apellidos = [
            $this->faker->lastName,
            $this->faker->lastName
        ];

        return [
            "nombres" => implode(' ', $nombres),
            "apellidos" => implode(' ', $apellidos)
        ];
    }
}
