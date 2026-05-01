<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Partida;
use App\Models\Personaje;

class AdminController extends Controller
{
    // Panel principal de administración
    public function index()
    {
        // Todos los usuarios con sus personajes cargados
        $usuarios = User::with('personajes')->orderBy('created_at', 'desc')->get();

        // Todas las partidas del sistema
        $partidas = Partida::with('creador')->orderBy('created_at', 'desc')->get();

        // Estadísticas generales
        $totalUsuarios   = User::count();
        $totalPartidas   = Partida::count();
        $totalPersonajes = Personaje::count();

        return view('admin.index', compact(
            'usuarios',
            'partidas',
            'totalUsuarios',
            'totalPartidas',
            'totalPersonajes'
        ));
    }

    // Elimina un usuario
    public function eliminarUsuario(User $user)
    {
        // No permitimos eliminar al propio administrador
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.index');
        }

        $user->delete();

        return redirect()->route('admin.index');
    }

    // Elimina una partida
    public function eliminarPartida(Partida $partida)
    {
        // Primero eliminamos las relaciones de la tabla incluir_personaje
        $partida->personajes()->detach();

        // Luego borramos los mensajes de la partida
        $partida->mensajes()->delete();

        // Borramos la imagen si existía
        if ($partida->imagen) {
            \Storage::disk('public')->delete($partida->imagen);
        }

        $partida->delete();

        return redirect()->route('admin.index');
    }

    // Elimina un personaje
    public function eliminarPersonaje(Personaje $personaje)
    {
        // Borramos la imagen si existía
        if ($personaje->imagen) {
            \Storage::disk('public')->delete($personaje->imagen);
        }

        $personaje->delete();

        return redirect()->route('admin.index');
    }
}