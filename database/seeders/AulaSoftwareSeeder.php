<?php

namespace Database\Seeders;

use App\Models\Aula;
use App\Models\Software;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class AulaSoftwareSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $softwares = Software::pluck('id')->toArray(); 
        $aulas = Aula::all();

        foreach ($aulas as $aula) {
            $randomSoftwareIds = Arr::random($softwares, 3); 

            $aula->softwares()->attach($randomSoftwareIds);
        }
    }
}
