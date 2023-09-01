<?php

namespace Database\Factories;

use App\Models\Carrera;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Nivel>
 */
class NivelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nombres = [
            "Primero",
            "Segundo",
            "Tercero",
            "Cuarto",
            "Quinto",
            "Sexto",
            "Septimo",
            "Octavo",
            "Noveno",
            "Decimo"
        ];

        $nombre = $this->faker->randomElement($nombres);
        $numero = array_search($nombre, $nombres) + 1;

        return [
            'nombre' => $nombre,
            'numero' => $numero,
            'carrera_id' => Carrera::all()->random()->id
        ];
    }
}
