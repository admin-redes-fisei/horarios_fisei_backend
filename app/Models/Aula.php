<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    use HasFactory;

    public function softwares()
    {
        return $this->belongsToMany(Software::class);
    }

    public function horarios(){
        return $this->hasMany(Horario::class);
    }

    public function puestos(){
        return $this->hasMany(Puesto::class);
    }

    public function caracteristicas(){
        return $this->hasMany(Caracteristica::class);
    }

}
