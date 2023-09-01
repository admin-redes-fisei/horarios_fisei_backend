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
     
        Nivel::factory()->create(60);

    }
}
