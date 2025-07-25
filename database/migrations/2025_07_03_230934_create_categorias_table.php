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
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }

    public function addComment(Request $request, Tareas $task) {
        $comment = $task->comentarios()->create([
            'id_usuario' => $request->user()->id,
            'cuerpo' => $request->cuerpo
        ]);

        return response()->json($comentarios, 201);
    }
};
