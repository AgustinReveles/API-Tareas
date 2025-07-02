<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tareas extends Model
{
    protected $table = 'tareas';
    protected $primaryKey = 'ID';
    protected $fillable = ['Titulo', 'Descripcion', 'FechaHora', 'Estado'];

    public function usuariosAsignados()
    {
        return $this->belongsToMany(Usuario::class, 'asignacion_tareas', 'IDTarea', 'IDUsuario')
                   ->withPivot('FechaHora');
    }

    public function historiales()
    {
        return $this->hasMany(Historial::class, 'IDTarea');
    }
}
