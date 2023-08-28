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
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('aula_id')->nullable();
            $table->foreign('aula_id')->references('id')->on('aulas')->onDelete('cascade');

            $table->unsignedBigInteger('actividad_id');
            $table->foreign('actividad_id')->references('id')->on('actividades')->onDelete('cascade');

            $table->unsignedBigInteger('docente_id');
            $table->foreign('docente_id')->references('id')->on('docentes')->onDelete('cascade');

            $table->unsignedBigInteger('periodo_id');
            $table->foreign('periodo_id')->references('id')->on('periodos')->onDelete('cascade');

            $table->unsignedBigInteger('puesto_id')->nullable();
            $table->foreign('puesto_id')->references('id')->on('puestos')->onDelete('cascade');

            $table->string('dia_semana');

            $table->tinyInteger('numero_dia');

            $table->string('hora_inicio');

            $table->string('hora_fin');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios');
    }
};
