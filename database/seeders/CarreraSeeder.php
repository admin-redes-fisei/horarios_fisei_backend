<?php

namespace Database\Seeders;

use App\Models\Carrera;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarreraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            
        $carreras = [
            [
                "nombre" => "Software",
            ],
            [
                "nombre" => "Telecomunicaciones",
            ],
            [
                "nombre" => "Industrial",
            ],
            [
                "nombre" => "Robotica",
            ],
            [
                "nombre" => "TI",
            ],
            // [
            //     "nombre" => "Electronica",
            // ],
            // [
            //     "nombre" => "Industrial en procesos de automatización",
            // ]
        ];

        foreach ($carreras as $carrera) {
            $nombre = $carrera['nombre'];

            Carrera::create([
                'nombre' => $nombre
            ]);
        }
    }
}
