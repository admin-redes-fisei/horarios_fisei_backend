<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Carrera;
use App\Models\Horario;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call(TituloSeeder::class);
        $this->call(DocenteSeeder::class);
        // $this->call(TituloDocenteSeeder::class);
     
        $this->call(PeriodoSeeder::class);
        // $this->call(NivelSeeder::class);
        $this->call(AulaSeeder::class);
        $this->call(SoftwareSeeder::class);
        // $this->call(AulaSoftwareSeeder::class);

        //Comentar datos falsos
        $this->call(CaracteristicaSeeder::class);
        $this->call(SugerenciaSeeder::class);
        // estos 2

        // $this->call(PuestoSeeder::class);
        $this->call(CarreraSeeder::class);
        // $this->call(NivelSeeder::class);
        $this->call(ParaleloSeeder::class);
        $this->call(ActividadSeeder::class);
        $this->call(HorarioSeeder::class);

        $this->call(RolSeeder::class);
    }
}
