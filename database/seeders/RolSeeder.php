<?php

namespace Database\Seeders;

use App\Models\Rol;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rol::create([
            "rol" => "Admin",
            "numero_rol" => "1"
        ]);

        Rol::create([
            "rol" => "Estudiante",
            "numero_rol" => "0"
        ]);
    }
}
