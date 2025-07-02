<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historiales extends Model
{
    protected $table = 'historiales';
    protected $fillable = ['IDTarea', 'IDUsuario', 'FechaHora', 'Accion'];

    public function tarea()
    {
        return $this->belongsTo(Tarea::class, 'IDTarea');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'IDUsuario');
    }
}
