<?php

namespace Database\Seeders;

use App\Models\Software;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SoftwareSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Software::factory(30)->create();

        $softwaresCSV = storage_path('app/carga/Softwares.csv');

        if (file_exists($softwaresCSV)) {
            $file = fopen($softwaresCSV, 'r');

            while (($line = fgets($file)) !== false) {
                $data = str_getcsv($line, ';');
                $campo1 = $data[0];
                $campo2 = $data[1];
                $campo3 = $data[2];

                // Intenta crear el registro en la base de datos
                $docente = Software::create([
                    'nombre' => $campo1,
                    'version' => $campo2,
                    'aula_id' => $campo3,
                ]);
            }

            fclose($file);
        }
    }
}
