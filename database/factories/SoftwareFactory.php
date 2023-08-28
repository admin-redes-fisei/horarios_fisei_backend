<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SoftwareFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $nombre = $this->faker->word();

        $major = $this->faker->randomNumber(1); 
        $minor = $this->faker->randomNumber(1); 

        $version = "$major.$minor";

        $descripcion = $this->faker->words(10, true);

        return [
            "nombre" => $nombre,
            "version" => $version,
            "descripcion" => $descripcion
        ];
    }
}
