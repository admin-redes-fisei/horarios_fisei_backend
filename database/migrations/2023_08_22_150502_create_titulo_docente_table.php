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
        Schema::create('docente_titulo', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('titulo_id');
            $table->unsignedBigInteger('docente_id');

            $table->foreign('titulo_id')->references('id')->on('titulos')->onDelete('cascade');
            $table->foreign('docente_id')->references('id')->on('docentes')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('titulo_docente');
    }
};
