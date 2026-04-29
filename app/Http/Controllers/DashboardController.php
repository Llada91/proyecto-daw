<?php

namespace App\Http\Controllers;

use App\Models\Partida;
use App\Models\Personaje;

class DashboardController extends Controller
{
    public function index()
    {
        // Partidas donde el usuario es director
        $partidasComoDirector = Partida::where('creador_id', auth()->id())
            ->latest()
            ->take(3)
            ->get();

        // Partidas donde el usuario es jugador
        $partidasComoJugador = Partida::whereHas('personajes', function ($query) {
            $query->where('usuario_id', auth()->id());
        })->where('creador_id', '!=', auth()->id())
            ->latest()
            ->take(3)
            ->get();

        // Personajes del usuario
        $personajes = Personaje::where('usuario_id', auth()->id())
            ->latest()
            ->take(3)
            ->get();

        return view('dashboard', compact(
            'partidasComoDirector',
            'partidasComoJugador',
            'personajes'
        ));
    }
}