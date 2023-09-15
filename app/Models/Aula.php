<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'edificio',
        'piso',
        'proyector',
        'aire',
        'cantidad_pc',
        'capacidad',
        'numero_edificio',
        'numero_piso'
    ];

    public function softwares()
    {
        return $this->hasMany(Software::class);
    }

    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }

    public function puestos()
    {
        return $this->hasMany(Puesto::class);
    }

    public function caracteristicas()
    {
        return $this->hasMany(Caracteristica::class);
    }

    public function sugerencias()
    {
        return $this->hasMany(Sugerencia::class);
    }
}
