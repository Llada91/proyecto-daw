<?php

namespace App\Http\Controllers;

use App\Models\Partida;
use App\Models\Personaje;

class DashboardController extends Controller
{
    public function index()
    {
        // ---- GRID DE PARTIDAS (las 2 últimas en las que participé) ----

        // Todas las partidas donde participo como director o jugador
        // ordenadas por más reciente, máximo 2
        $ultimasPartidas = Partida::where('creador_id', auth()->id())
            ->orWhereHas('personajes', function ($query) {
                $query->where('usuario_id', auth()->id());
            })
            ->latest()
            ->take(2)
            ->get();


        // ---- ACTIVIDAD RECIENTE (todo sin límite por tipo, máximo 10) ----

        // Todas las partidas donde participo
        $partidasActividad = Partida::where('creador_id', auth()->id())
            ->orWhereHas('personajes', function ($query) {
                $query->where('usuario_id', auth()->id());
            })
            ->get()
            ->map(function ($partida) {
                $partida->tipo_actividad = 'partida';
                return $partida;
            });

        // Todos mis personajes
        $personajesActividad = Personaje::where('usuario_id', auth()->id())
            ->get()
            ->map(function ($personaje) {
                $personaje->tipo_actividad = 'personaje';
                return $personaje;
            });

        // Mezclamos, ordenamos por fecha y cogemos los 10 más recientes
        $actividad = $partidasActividad
            ->concat($personajesActividad)
            ->sortByDesc('created_at')
            ->take(10)
            ->values();

        return view('dashboard', compact(
            'ultimasPartidas',
            'actividad'
        ));
    }
}