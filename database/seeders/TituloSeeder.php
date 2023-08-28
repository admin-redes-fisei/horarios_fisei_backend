<?php

namespace Database\Seeders;

use App\Models\Titulo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TituloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nivelEstudios = [
            [
                "nombre" => "Ingeniero",
                "abreviatura" => "Ing.",
            ],
            [
                "nombre" => "Magíster",
                "abreviatura" => "Mg.",
            ],
            [
                "nombre" => "Doctorado",
                "abreviatura" => "PhD.",
            ],
        ];

        foreach ($nivelEstudios as $nivel) {
            $nombre = $nivel['nombre'];
            $abreviatura = $nivel['abreviatura'];

            Titulo::create([
                'nombre' => $nombre,
                'abreviatura' => $abreviatura
            ]);
        }
    }
}
