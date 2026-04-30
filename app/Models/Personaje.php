<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personaje extends Model
{
    // Campos que se pueden rellenar al crear o editar un personaje
    protected $fillable = [
        'usuario_id',
        'datos',
        'imagen',
    ];

    // Le decimos a Laravel que el campo datos es un JSON
    // Laravel lo convierte automáticamente a array al leerlo
    protected $casts = [
        'datos' => 'array',
    ];

    // Un personaje pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    // Un personaje puede estar en muchas partidas a través de incluir_personaje
    public function partidas()
    {
        return $this->belongsToMany(Partida::class, 'incluir_personaje');
    }

    // Un personaje tiene muchos mensajes
    public function mensajes()
    {
        return $this->hasMany(Mensaje::class);
    }

}