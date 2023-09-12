<?php

namespace Database\Seeders;

use App\Models\Aula;
use App\Models\Software;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class AulaSoftwareSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $softwares = Software::pluck('id')->toArray(); 
        // $aulas = Aula::all();

        // foreach ($aulas as $aula) {
        //     $randomSoftwareIds = Arr::random($softwares, 3); 

        //     $aula->softwares()->attach($randomSoftwareIds);
        // }


        $laboratoriosSoftwareCSV = storage_path('app/carga/Software-Aula.csv');

        if (file_exists($laboratoriosSoftwareCSV)) {
            $file = fopen($laboratoriosSoftwareCSV, 'r');

            while (($line = fgets($file)) !== false) {
                $data = str_getcsv($line, ';');
                $campo1 = $data[0];
                $campo2 = $data[1];

                $laboratorio = Aula::find($campo1);
                $software = Software::where('id', $campo2)->first();

                if ($laboratorio && $software) {
                    $laboratorio->softwares()->attach($software->id);
                }
            }

            fclose($file);
        }
    }
}
