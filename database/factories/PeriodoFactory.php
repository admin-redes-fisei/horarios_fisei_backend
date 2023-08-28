<?php

namespace Database\Factories;

use App\Models\Periodo;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Periodo>
 */
class PeriodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $fechaInicio = Carbon::create(2023, 9, 16);
        $fechaFin = Carbon::create(2024, 2, 29);


        return [
            "nombre" => "Periodo Septiembre 2023 - Febrero 2024",
            "fecha_inicio" => $fechaInicio,
            "fecha_fin" => $fechaFin
        ];
    }
}
