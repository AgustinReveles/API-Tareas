<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tareas extends Model
{
    use HasFactory;

    protected $table = 'tareas';

    protected $fillable = [
        'titulo',
        'cuerpo',
        'estado',
        'fecha_expiracion',
        'id_autor',
        'id_usuario_asignado',
    ];

    public function categorias()
    {
        return $this->belongsToMany(Categorias::class, 'categorias_tareas', 'id_tareas', 'id_categorias');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentarios::class, 'id_tareas');
    }
}
