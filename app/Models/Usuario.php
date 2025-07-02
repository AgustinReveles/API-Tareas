<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'ID';
    protected $fillable = ['Nombre_Usuario', 'Nombre_Completo', 'Email'];

    public function tareasAsignadas()
    {
        return $this->belongsToMany(Tarea::class, 'asignacion_tareas', 'IDUsuario', 'IDTarea')
                   ->withPivot('FechaHora');
    }
}
