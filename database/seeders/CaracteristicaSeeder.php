<?php

namespace Database\Seeders;

use App\Models\Caracteristica;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CaracteristicaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Caracteristica::factory(30)->create();
    }
}
