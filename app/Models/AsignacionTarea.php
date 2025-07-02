<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsignacionTarea extends Model
{
    protected $table = 'asignacion_tareas';
    protected $fillable = ['IDTarea', 'IDUsuario', 'FechaHora'];
    
    public $incrementing = false;
    protected $primaryKey = null;
}
