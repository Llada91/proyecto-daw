<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partida extends Model
{
    // Campos que se pueden rellenar al crear o editar una partida
    protected $fillable = [
        'nombre',
        'descripcion',
        'imagen',
        'creador_id',
    ];

    // Una partida pertenece a un usuario (el director)
    // Usamos creador_id en vez del id por defecto
    public function creador()
    {
        return $this->belongsTo(User::class, 'creador_id');
    }

    // Una partida tiene muchos personajes a través de incluir_personaje
    public function personajes()
    {
        return $this->belongsToMany(Personaje::class, 'incluir_personaje');
    }
}