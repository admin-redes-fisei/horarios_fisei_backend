<?php

namespace Database\Seeders;

use App\Models\Docente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Docente::factory(30)->create();

        $profesoresCSV = storage_path('app/carga/profesoresCSV.csv');

        if (file_exists($profesoresCSV)) {
            $file = fopen($profesoresCSV, 'r');

            while (($line = fgets($file)) !== false) {
                $data = str_getcsv($line, ';');
                $campo1 = $data[0];
                $campo2 = $data[1];

                // Intenta crear el registro en la base de datos
                $docente = Docente::create([
                    'cedula' => $campo2,
                    'docente' => $campo1,
                ]);
            }

            fclose($file);
        }
    }
}
