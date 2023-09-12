<?php

namespace Database\Seeders;

use App\Models\Aula;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AulaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Aula::factory(40)->create();

        $laboratoriosCSV = storage_path('app/carga/laboratorios.csv');

        if (file_exists($laboratoriosCSV)) {
            $file = fopen($laboratoriosCSV, 'r');

            while (($line = fgets($file)) !== false) {
                $data = str_getcsv($line, ';');
                $campo1 = $data[0];
                $campo2 = $data[1];
                $campo3 = $data[2];
                $campo4 = $data[3];
                $campo5 = $data[4];
                $campo6 = $data[5];
                $campo7 = $data[6];

                // Intenta crear el registro en la base de datos
                Aula::create([
                    'nombre' => $campo1,
                    'edificio' => $campo2,
                    'numero_edificio' => $campo3,
                    'piso' => $campo4,
                    'numero_piso' => $campo5,
                    'cantidad_pc' => $campo6,
                    'capacidad' => $campo7
                ]);
            }

            fclose($file);
        }

    }
}
