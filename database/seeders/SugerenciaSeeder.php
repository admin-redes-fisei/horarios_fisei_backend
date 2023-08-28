<?php

namespace Database\Seeders;

use App\Models\Sugerencia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SugerenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sugerencia::factory(30)->create();
    }
}
