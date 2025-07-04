<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tareas;
use App\Models\Categorias;
use App\Models\Comentarios;
use Illuminate\Support\Facades\Http;

abstract class Controller
{
    public function index(Request $request) {
        return Tareas::with('categorias', 'comentarios')->get();
        return Cache::remember('tareas.all', 60, function () {
        return Tareas::with('categorias')->get();
    });
    }

    public function store(Request $request) {
        $tareas = Tareas::create([
            'titulo' => $request->titulo,
            'cuerpo' => $request->cuerpo,
            'id_autor' => $request->user()->id,
            'estado' => 'nuevo'
        ]);

        $tareas->categorias()->attach($request->categorias_ids);

        Http::post(config('services.api_historial.url').'/log', [
            'titulo_tareas' => $tareas->titulo,
            'estado' => $tareas->estado,
            'id_usuario' => $tareas->id_autor
        ]);

        return response()->json($tareas, 201);
    }

}
