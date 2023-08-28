<?php

namespace Database\Factories;

use App\Models\Actividad;
use App\Models\Aula;
use App\Models\Docente;
use App\Models\Materia;
use App\Models\Periodo;
use App\Models\Puesto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Horario>
 */
class HorarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $actividades = Actividad::pluck('id')->toArray();
        $docentes = Docente::pluck('id')->toArray();
        $periodo = Periodo::where('estado', 1)->first(); // Assuming you expect only one active period

        // $diasSemana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];
        // $diaSeleccionado = $this->faker->randomElement($diasSemana);
        // $numeroDia = array_search($diaSeleccionado, $diasSemana) + 1;

        $var = $this->faker->numberBetween($min = 1, $max = 5);

        $dia = '';
        $numeroDia = 0;

        switch ($var) {
            case '1':
                $dia = 'Lunes';
                $numeroDia = 1;
                break;
            case '2':
                $dia = 'Martes';
                $numeroDia = 2;
                break;
            case '3':
                $dia = 'Miercoles';
                $numeroDia = 3;
                break;
            case '4':
                $dia = 'Jueves';
                $numeroDia = 4;
                break;
            default:
                $dia = 'Viernes';
                $numeroDia = 5;
                break;
        }

        $horaInicioClases = 8; // 8am
        $horaFinClases = 17; // 5pm

        // Decide whether to use an aula or a puesto
        $useAula = $this->faker->boolean;

        if ($useAula) {
            $aulas = Aula::pluck('id')->toArray();
            $puesto_id = null;
            $aula_id = $this->faker->randomElement($aulas);
        } else {
            $puestos = Puesto::pluck('id')->toArray();
            $aula_id = null;
            $puesto_id = $this->faker->randomElement($puestos);
        }

        return [
            'aula_id' => $aula_id,
            'actividad_id' => $this->faker->randomElement($actividades),
            'docente_id' => $this->faker->randomElement($docentes),
            'periodo_id' => $periodo->id,
            'puesto_id' => $puesto_id,
            'dia_semana' => $dia,
            'numero_dia' => $numeroDia,
            'hora_inicio' => $horaInicioClases + $this->faker->numberBetween(0, 4),
            'hora_fin' => $horaFinClases - $this->faker->numberBetween(0, 3),
        ];
    }
}
