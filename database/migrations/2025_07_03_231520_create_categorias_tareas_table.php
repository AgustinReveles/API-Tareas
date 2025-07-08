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
        Schema::create('categorias_tareas', function (Blueprint $table) {
            $table->unsignedBigInteger('id_tareas');
            $table->unsignedBigInteger('id_categorias');
            $table->timestamps();
            $table->foreign('id_tareas')
                  ->references('id')
                  ->on('tareas')
                  ->onDelete('cascade');
            $table->foreign('id_categorias')
                  ->references('id')
                  ->on('categorias')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias_tareas');
    }
};
