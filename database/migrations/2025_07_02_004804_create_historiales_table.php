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
        Schema::create('historiales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('IdTarea')->constrained('Tareas');
            $table->foreignId('IdUsuario')->constrained('Usuario');
            $table->dateTime('FechaHora');
            $table->string('Accion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historiales');
    }
};
