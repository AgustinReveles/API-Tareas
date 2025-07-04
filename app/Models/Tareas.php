<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tareas extends Model {
    protected $fillable = ['titulo', 'cuerpo', 'id_autor', 'id_user_asignado', 'estado', 'expiracion'];

    public function categories() {
        return $this->belongsToMany(Categorias::class);
    }

    public function comments() {
        return $this->hasMany(Comentarios::class);
    }
}