<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
    use HasFactory;

    public function aula(){
        return $this->belongsTo(Aula::class);
    }

    public function horarios(){
        return $this->hasMany(Horario::class);
    }
}
