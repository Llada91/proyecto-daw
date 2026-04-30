<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    // Campos que se pueden rellenar
    protected $fillable = [
        'partida_id',
        'personaje_id',
        'tipo',
        'contenido',
    ];

    // Un mensaje pertenece a una partida
    public function partida()
    {
        return $this->belongsTo(Partida::class);
    }

    // Un mensaje pertenece a un personaje
    public function personaje()
    {
        return $this->belongsTo(Personaje::class);
    }
}