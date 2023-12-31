<?php

namespace Database\Factories;

use App\Models\Aula;
use App\Models\Carrera;
use App\Models\Nivel;
use App\Models\Paralelo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ActividadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $materia = $this->faker->sentence();

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



        $nivel = $this->faker->randomElement($nombres);


        return [
            "nombre" => $materia,
            "nivel" => $nivel,
            "carrera_id" => Carrera::all()->random()->id,
            "paralelo_id" => Paralelo::all()->random()->id
        ];
    }
}
