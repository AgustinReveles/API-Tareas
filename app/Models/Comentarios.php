<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentarios extends Model
{
    use HasFactory;

    protected $table = 'comentarios';

    protected $fillable = [
        'cuerpo',
        'id_usuario',
        'id_tareas',
    ];

    public function tarea()
    {
        return $this->belongsTo(Tareas::class, 'id_tareas');
    }
}
