<?php

namespace Database\Seeders;

use App\Models\Carrera;
use App\Models\Nivel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NivelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     
        $nombres = [
            "Nivelación",
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

        $aux = 0;
        foreach ($nombres as $nombre) {
            Nivel::create([
                'nombre' => $nombre,
                'numero' => $aux++
            ]);
        }

    }
}
