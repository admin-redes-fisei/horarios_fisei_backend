<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;

    protected $table = 'actividades';

    protected $fillable = ['nombre', 'carrera_id', 'nivel', 'numero_nivel'];


    public function paralelo()
    {
        return $this->belongsTo(Paralelo::class);
    }

    public function carrera()
    {
        return $this->belongsTo(Carrera::class);
    }

    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }
    

}
