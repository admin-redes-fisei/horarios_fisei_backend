<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;
    protected $fillable = ['cedula', 'docente'];

    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }

    public function titulos()
    {
        return $this->belongsToMany(Titulo::class);
    }
}
