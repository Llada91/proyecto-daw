<?php

namespace App\Http\Controllers;

use App\Models\Partida;
use App\Models\Personaje;
use Illuminate\Http\Request;

class PartidaController extends Controller
{
    // Muestra la lista de partidas del usuario
    public function index()
    {
        $partidasComoDirector = Partida::where('creador_id', auth()->id())->get();

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
        $request->validate([
            'nombre'      => 'required|max:255',
            'descripcion' => 'nullable',
            'imagen'      => 'nullable|image|max:2048',
        ]);

        $rutaImagen = null;
        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('partidas', 'public');
        }

        Partida::create([
            'nombre'      => $request->nombre,
            'descripcion' => $request->descripcion,
            'imagen'      => $rutaImagen,
            'creador_id'  => auth()->id(),
        ]);

        return redirect()->route('partidas.index');
    }

    // Muestra el detalle de una partida
    // Solo pueden verla el director y los jugadores con personaje en ella
    public function show(Partida $partida)
    {
        $esDirector = auth()->id() === $partida->creador_id;
        $esJugador  = $partida->personajes->where('usuario_id', auth()->id())->count() > 0;

        if (!$esDirector && !$esJugador) {
            return redirect()->route('partidas.index');
        }

        return view('partidas.show', compact('partida'));
    }

    // Muestra el formulario para editar una partida
    public function edit(Partida $partida)
    {
        if (auth()->id() !== $partida->creador_id) {
            return redirect()->route('partidas.index');
        }

        return view('partidas.edit', compact('partida'));
    }

    // Guarda los cambios de la partida
    public function update(Request $request, Partida $partida)
    {
        if (auth()->id() !== $partida->creador_id) {
            return redirect()->route('partidas.index');
        }

        $request->validate([
            'nombre'      => 'required|max:255',
            'descripcion' => 'nullable',
            'imagen'      => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            if ($partida->imagen) {
                \Storage::disk('public')->delete($partida->imagen);
            }
            $partida->imagen = $request->file('imagen')->store('partidas', 'public');
        }

        $partida->nombre      = $request->nombre;
        $partida->descripcion = $request->descripcion;
        $partida->save();

        return redirect()->route('partidas.index');
    }

    // Elimina una partida
    public function destroy(Partida $partida)
    {
        if (auth()->id() !== $partida->creador_id) {
            return redirect()->route('partidas.index');
        }

        // Primero eliminamos las relaciones de la tabla incluir_personaje
        $partida->personajes()->detach();

        // Luego borramos los mensajes de la partida
        $partida->mensajes()->delete();

        // Borramos la imagen si existía
        if ($partida->imagen) {
            \Storage::disk('public')->delete($partida->imagen);
        }

        $partida->delete();

        return redirect()->route('partidas.index');
    }

    // Muestra el listado de personajes disponibles para invitar
    public function invitar(Partida $partida)
    {
        if (auth()->id() !== $partida->creador_id) {
            return redirect()->route('partidas.show', $partida);
        }

        $personajesDisponibles = Personaje::whereNotIn(
            'id',
            $partida->personajes->pluck('id')
        )->get();

        return view('partidas.invitar', compact('partida', 'personajesDisponibles'));
    }

    // Añade el personaje a la partida
    public function agregarPersonaje(Request $request, Partida $partida)
    {
        if (auth()->id() !== $partida->creador_id) {
            return redirect()->route('partidas.show', $partida);
        }

        $partida->personajes()->attach($request->personaje_id);

        return redirect()->route('partidas.show', $partida);
    }

    // Quita el personaje de la partida
    public function quitarPersonaje(Request $request, Partida $partida)
    {
        if (auth()->id() !== $partida->creador_id) {
            return redirect()->route('partidas.show', $partida);
        }

        $partida->personajes()->detach($request->personaje_id);

        return redirect()->route('partidas.invitar', $partida);
    }
}