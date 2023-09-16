<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'version',
        'aula_id'
    ];

    public function aula()
    {
        return $this->belongsTo(Aula::class);
    }
}
