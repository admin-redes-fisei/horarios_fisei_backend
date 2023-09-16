<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $fillable = [
        'aula_id',
        'docente_id',
        'actividad_id',
        'paralelo_id',
        'hora_inicio',
        'hora_fin',
        'numero_dia',
        'dia_semana',
        'numero_puesto'
    ];

    public function puesto()
    {
        return $this->belongsTo(Puesto::class);
    }

    public function aula()
    {
        return $this->belongsTo(Aula::class);
    }

    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }

    public function actividad()
    {
        return $this->belongsTo(Actividad::class);
    }

    public function paralelo()
    {
        return $this->belongsTo(Paralelo::class);
    }
}
