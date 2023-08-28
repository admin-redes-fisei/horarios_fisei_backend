<?php

namespace Database\Seeders;

use App\Models\Docente;
use App\Models\Titulo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TituloDocenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $docentes = Docente::all();
        $titulos = Titulo::all();

        $aux = 1;

        foreach ($docentes as $docente){

            if ($aux % 2 == 0) {
                $docente->titulos()->attach([$titulos[0]['id'], $titulos[1]['id']]);
            }else{
                $docente->titulos()->attach([$titulos[0]['id'], $titulos[1]['id'], $titulos[2]['id']]);
            }

            $aux++;
        }
    }
}
