<?php

namespace Database\Seeders;

use App\Models\Actividad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActividadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    protected $table = 'actividades';

    public function run(): void
    {
        // Actividad::factory(50)->create();


        $materiasCSV = storage_path('app/carga/materias1.csv');

        if (file_exists($materiasCSV)) {
            $file = fopen($materiasCSV, 'r');
   

            while (($line = fgets($file)) !== false) {
                $data = str_getcsv($line, ';');
                $campo1 = $data[0];
                $idCarrera = $data[1];
                $nivel = $data[2];
                $numeroN = $data[3];

                // Intenta crear el registro en la base de datos
                Actividad::create([
                    'nombre' => $campo1,
                    'nivel' => $nivel,
                    'numero_nivel' => $numeroN,
                    'carrera_id' => $idCarrera
                ]);

       
            }

            fclose($file);
        }
    }
}
