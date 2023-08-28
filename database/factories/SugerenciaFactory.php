<?php

namespace Database\Factories;

use App\Models\Aula;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SugerenciaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nombre = $this->faker->word();

        $descripcion = $this->faker->words(20, true);

        $aulaIds = Aula::pluck('id')->toArray();

        return [
            "nombre" => $nombre,
            "descripcion" => $descripcion,
            "aula_id" => $this->faker->randomElement($aulaIds)
        ];
    }
}
