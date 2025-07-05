<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tareas;
use App\Models\Categorias;
use App\Models\Comentarios;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class TareasController extends Controller
{
    public function index()
    {
        return Cache::remember('tareas.all', 60, function () {
            return Tareas::with('categorias', 'comentarios')->get();
        });
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'cuerpo' => 'required|string',
            'categorias_ids' => 'array',
            'categorias_ids.*' => 'integer|exists:categorias,id',
        ]);

        $tarea = Tareas::create([
            'titulo' => $request->titulo,
            'cuerpo' => $request->cuerpo,
            'id_autor' => $request->user()->id,
            'estado' => 'nuevo'
        ]);

        if ($request->has('categorias_ids')) {
            $tarea->categorias()->attach($request->categorias_ids);
        }

        $this->logHistorial([
            'titulo_tarea' => $tarea->titulo,
            'estado' => $tarea->estado,
            'id_usuario' => $tarea->id_autor,
            'fecha' => now()->toDateTimeString(),
        ]);

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

        $request->validate([
            'titulo' => 'sometimes|string|max:255',
            'cuerpo' => 'sometimes|string',
            'estado' => 'sometimes|string',
            'categorias_ids' => 'sometimes|array',
            'categorias_ids.*' => 'integer|exists:categorias,id',
        ]);

        $tarea->update($request->only(['titulo', 'cuerpo', 'estado']));

        if ($request->has('categorias_ids')) {
            $tarea->categorias()->sync($request->categorias_ids);
        }

        $this->logHistorial([
            'titulo_tarea' => $tarea->titulo,
            'estado' => $tarea->estado,
            'id_usuario' => $tarea->id_autor,
            'fecha' => now()->toDateTimeString(),
        ]);

        return response()->json($tarea);
    }

    public function destroy($id)
    {
        $tarea = Tareas::findOrFail($id);
        $this->logHistorial([
            'titulo_tarea' => $tarea->titulo,
            'estado' => $tarea->estado,
            'id_usuario' => $tarea->id_autor,
            'fecha' => now()->toDateTimeString(),
            'accion' => 'eliminada',
        ]);
        $tarea->delete();

        return response()->json(null, 204);
    }

    public function addComentarios(Request $request, $id)
    {
        $request->validate([
            'contenido' => 'required|string',
        ]);

        $tarea = Tareas::findOrFail($id);

        $comentario = new Comentarios();
        $comentario->contenido = $request->contenido;
        $comentario->id_tarea = $id;
        $comentario->id_usuario = $request->user()->id;
        $comentario->save();

        return response()->json($comentario, 201);
    }

    private function logHistorial(array $data)
    {
        $response = Http::withHeaders([
            'Authorizacion' => 'Bearer ' . config('services.api_historial.token'),
        ])->post(config('services.api_historial.url') . '/log', $data);

        if ($response->failed()) {
            \Log::error('Error al registrar log en API historial', [
                'response' => $response->cuerpo(),
                'data_sent' => $data,
            ]);
        }

    }

}
