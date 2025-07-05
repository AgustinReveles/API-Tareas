<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    use HasFactory;

    protected $table = 'categorias';

    protected $fillable = ['nombre'];

    public function tareas()
    {
        return $this->belongsToMany(Tareas::class, 'categorias_tareas', 'id_categorias', 'id_tareas');
    }
}
