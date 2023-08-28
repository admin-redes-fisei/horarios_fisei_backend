<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AulaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $nombreAula = $this->faker->word();
        
        $nombresEdificio = ['Edificio 1', 'Edificio 2'];
        $edificio = $this->faker->randomElement($nombresEdificio);
        
        $numeroEdificio = ($edificio === 'Edificio 1') ? 1 : 2;

        if ($edificio === 'Edificio 1') {
            $pisosPosibles = ['Piso 1', 'Piso 2', 'Piso 3'];
        } else {
            $pisosPosibles = ['Piso 1', 'Piso 2', 'Piso 3', 'Piso 4', 'Piso 5'];
        }
        
        $piso = $this->faker->randomElement($pisosPosibles);

        $res = explode(' ' , $piso);
        $numeroPiso = intval($res[1]);

        $proyector = $this->faker->boolean;
        
        $aire = $this->faker->boolean;

        $cantidadPc = $this->faker->numberBetween($min = 0, $max = 50);

        $capacidad = $this->faker->numberBetween($min = 0, $max = 45);

       

        return [
            "nombre" => $nombreAula,
            "edificio" => $edificio,
            "numero_edificio" => $numeroEdificio,
            "piso" => $piso,
            "numero_piso" => $numeroPiso,
            "proyector" => $proyector,
            "aire" => $aire,
            "cantidad_pc" => $cantidadPc,
            "capacidad" => $capacidad,
        ];
    }
}
