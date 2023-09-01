<?php

namespace Database\Seeders;

use App\Models\Carrera;
use App\Models\Nivel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarreraNivelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carreras = Carrera::all();
        $niveles = Nivel::all();
    
        foreach ($carreras as $carrera) {
            $nivelIds = $niveles->pluck('id')->toArray();
            $carrera->niveles()->attach($nivelIds);
        }

    }
}
