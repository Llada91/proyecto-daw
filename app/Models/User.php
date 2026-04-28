<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Un usuario puede haber creado muchas partidas (como director)
    public function partidasComoDirector()
    {
        return $this->hasMany(Partida::class, 'creador_id');
    }

    // Un usuario puede tener muchos personajes
    public function personajes()
    {
        return $this->hasMany(Personaje::class, 'usuario_id');
    }
}