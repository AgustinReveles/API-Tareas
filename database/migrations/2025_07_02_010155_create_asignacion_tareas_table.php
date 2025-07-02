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
        Schema::create('asignacion_tareas', function (Blueprint $table) {
            $table->foreignId('IDTarea')->constrained('tareas');
            $table->foreignId('IDUsuario')->constrained('usuarios');
            $table->dateTime('FechaHora');
            $table->primary(['IDTarea', 'IDUsuario', 'FechaHora']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignacion_tareas');
    }
};
