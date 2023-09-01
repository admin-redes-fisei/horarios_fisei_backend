<?php

namespace Database\Seeders;

use App\Models\Actividad;
use App\Models\Paralelo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParaleloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nombres = ['A', 'B', 'C', 'D'];

        foreach ($nombres as $nombre) {
            Paralelo::create([
                "nombre" => $nombre,
            ]);
        }
    }
}
