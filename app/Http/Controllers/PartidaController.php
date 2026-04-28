<?php

namespace App\Http\Controllers;

use App\Models\Partida;
use Illuminate\Http\Request;

class PartidaController extends Controller
{
    // Muestra la lista de partidas del usuario
    public function index()
    {
        // Partidas donde el usuario es director
        $partidasComoDirector = Partida::where('creador_id', auth()->id())->get();

        // Partidas donde el usuario es jugador (tiene un personaje incluido)
        $partidasComoJugador = Partida::whereHas('personajes', function ($query) {
            $query->where('usuario_id', auth()->id());
        })->where('creador_id', '!=', auth()->id())->get();

        return view('partidas.index', compact('partidasComoDirector', 'partidasComoJugador'));
    }

    // Muestra el formulario para crear una partida
    public function create()
    {
        return view('partidas.create');
    }

    // Guarda la nueva partida en la base de datos
    public function store(Request $request)
    {
        // Validamos los datos del formulario
        $request->validate([
            'nombre'      => 'required|max:255',
            'descripcion' => 'nullable',
        ]);

        // Creamos la partida con el usuario actual como director
        Partida::create([
            'nombre'      => $request->nombre,
            'descripcion' => $request->descripcion,
            'creador_id'  => auth()->id(),
        ]);

        // Redirigimos al listado de partidas
        return redirect()->route('partidas.index');
    }

    // Muestra el detalle de una partida
    public function show(Partida $partida)
    {
        return view('partidas.show', compact('partida'));
    }

    // Muestra el formulario para editar una partida
    public function edit(Partida $partida)
    {
        // Solo el director puede editar su partida
        if (auth()->id() !== $partida->creador_id) {
            return redirect()->route('partidas.index');
        }

        return view('partidas.edit', compact('partida'));
    }

    // Guarda los cambios de la partida
    public function update(Request $request, Partida $partida)
    {
        // Solo el director puede editar su partida
        if (auth()->id() !== $partida->creador_id) {
            return redirect()->route('partidas.index');
        }

        // Validamos los datos del formulario
        $request->validate([
            'nombre'      => 'required|max:255',
            'descripcion' => 'nullable',
        ]);

        $partida->update([
            'nombre'      => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('partidas.index');
    }

    // Elimina una partida
    public function destroy(Partida $partida)
    {
        // Solo el director puede eliminar su partida
        if (auth()->id() !== $partida->creador_id) {
            return redirect()->route('partidas.index');
        }

        $partida->delete();

        return redirect()->route('partidas.index');
    }
}