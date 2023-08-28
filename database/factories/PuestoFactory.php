<?php

namespace Database\Factories;

use App\Models\Aula;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Puesto>
 */
class PuestoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $numeroPuesto = $this->faker->numberBetween($min = 1, $max = 20);

        $aulas = Aula::pluck('id')->toArray();

        return [
            "numero_puesto" => $numeroPuesto,
            "aula_id" => $this->faker->randomElement($aulas)
        ];
    }
}
