<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;

    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }

    public function titulos()
    {
        return $this->belongsToMany(Titulo::class);
    }
}
