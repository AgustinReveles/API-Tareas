<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tareas;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class TareasController extends Controller
{
    public function index()
    {
        return Cache::remember('tareas', 60, function () {
            return Tareas::with('categorias', 'comentarios')->get();
        });
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'cuerpo' => 'required|string',
            'estado' => 'required|string',
            'fecha_expiracion' => 'nullable|date',
            'categorias' => 'nullable|array'
        ]);

        $tarea = new Tareas();
        $tarea->titulo = $request->titulo;
        $tarea->cuerpo = $request->cuerpo;
        $tarea->estado = $request->estado;
        $tarea->fecha_expiracion = $request->fecha_expiracion;
        $tarea->id_autor = $request->user()->id;
        $tarea->id_usuario_asignado = $request->id_usuario_asignado ?? null;
        $tarea->save();

        if ($request->has('categorias')) {
            $tarea->categorias()->sync($request->categorias);
        }

        $data = [
            'titulo_tarea' => $tarea->titulo,
            'estado' => $tarea->estado,
            'id_usuario' => $tarea->id_autor,
        ];

        Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.api_historial.token'),
        ])->post(config('services.api_historial.url') . '/log', $data);

        return response()->json($tarea, 201);
    }

    public function show($id)
    {
        $tarea = Tareas::with('categorias', 'comentarios')->findOrFail($id);
        return response()->json($tarea);
    }

    public function update(Request $request, $id)
    {
        $tarea = Tareas::findOrFail($id);
        $tarea->update($request->only([
            'titulo', 'cuerpo', 'estado', 'fecha_expiracion', 'id_usuario_asignado'
        ]));

        if ($request->has('categorias')) {
            $tarea->categorias()->sync($request->categorias);
        }

        return response()->json($tarea);
    }

    public function destroy($id)
    {
        $tarea = Tareas::findOrFail($id);
        $tarea->delete();
        return response()->json(['mensaje' => 'Tarea eliminada']);
    }

    public function addComentarios(Request $request, $id)
    {
        $request->validate([
            'cuerpo' => 'required|string',
        ]);

        $tarea = Tareas::findOrFail($id);

        $comentario = $tarea->comentarios()->create([
            'cuerpo' => $request->cuerpo,
            'id_usuario' => $request->user()->id, // ✔ corregido aquí
        ]);

        return response()->json($comentario, 201);
    }
}
