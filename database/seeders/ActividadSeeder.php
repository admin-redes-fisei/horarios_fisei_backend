<?php

namespace Database\Seeders;

use App\Models\Actividad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActividadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

     protected $table = 'actividades';

    public function run(): void
    {
        Actividad::factory(20)->create();
    }
}
