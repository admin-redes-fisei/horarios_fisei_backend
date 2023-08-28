<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    public function puesto(){
        return $this->belongsTo(Puesto::class);
    }

    public function aula(){
        return $this->belongsTo(Aula::class);
    }

    public function docente(){
        return $this->belongsTo(Docente::class);
    }

    public function actividad(){
        return $this->belongsTo(Actividad::class);
    }

}
