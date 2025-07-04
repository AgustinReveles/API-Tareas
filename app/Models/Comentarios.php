<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentarios extends Model
{
    protected $fillable = ['id_tareas', 'id_user', 'cuerpo'];
}
