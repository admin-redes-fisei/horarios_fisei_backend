<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('aulas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('edificio');
            $table->tinyInteger('numero_edificio');
            $table->string('piso');
            $table->tinyInteger('numero_piso');
            $table->boolean('proyector')->nullable();
            $table->boolean('aire')->nullable();            
            $table->integer('cantidad_pc');
            $table->integer('capacidad');
            // $table->string('puesto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aulas');
    }
};
