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
        Schema::create('actividades', function (Blueprint $table) {
            
            $table->id();
            $table->string('nombre');
            
            $table->string('nivel');

            $table->string('numero_nivel');

            $table->unsignedBigInteger('carrera_id');
            $table->foreign('carrera_id')->references('id')->on('carreras')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actividades');
    }
};
