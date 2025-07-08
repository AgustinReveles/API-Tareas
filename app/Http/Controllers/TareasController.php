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
        return Cache::remember('tareas', 60, fn() =>
            Tareas::with('categorias','comentarios')->get()
        );
    }

    public function store(Request $request)
    {
        $userId = $request->user()?->id ?? null;

        $request->validate([
            'titulo'           => 'required|string|max:255',
            'cuerpo'           => 'required|string',
            'estado'           => 'required|string',
            'fecha_expiracion' => 'nullable|date',
            'categorias'       => 'nullable|array',
        ]);

        $t = new Tareas();
        $t->titulo              = $request->titulo;
        $t->cuerpo              = $request->cuerpo;
        $t->estado              = $request->estado;
        $t->fecha_expiracion    = $request->fecha_expiracion;
        $t->id_autor            = $userId;
        $t->id_usuario_asignado = $request->id_usuario_asignado ?? null;
        $t->save();

        if ($request->has('categorias')) {
            $t->categorias()->sync($request->categorias);
        }

        Http::withHeaders([
            'Authorization' => 'Bearer '.config('services.api_historial.token'),
        ])->post(config('services.api_historial.url').'/log', [
            'titulo_tarea' => $t->titulo,
            'estado'       => $t->estado,
            'id_usuario'   => $userId,
        ]);

        return response()->json($t, 201);
    }

    public function show($id)
    {
        $t = Tareas::with('categorias','comentarios')->findOrFail($id);
        return response()->json($t);
    }

    public function update(Request $request, $id)
    {
        $t = Tareas::findOrFail($id);
        $t->update($request->only([
            'titulo','cuerpo','estado','fecha_expiracion','id_usuario_asignado'
        ]));
        if ($request->has('categorias')) {
            $t->categorias()->sync($request->categorias);
        }
        return response()->json($t);
    }

    public function destroy($id)
    {
        Tareas::findOrFail($id)->delete();
        return response()->json(['mensaje'=>'Tarea eliminada']);
    }

    public function addComentarios(Request $request, $id)
    {
        $request->validate(['cuerpo'=>'required|string']);
        $t = Tareas::findOrFail($id);
        $c = $t->comentarios()->create([
            'cuerpo'     => $request->cuerpo,
            'id_usuario' => $request->user()?->id,
        ]);
        return response()->json($c, 201);
    }
}
