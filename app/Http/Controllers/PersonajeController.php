<?php

namespace App\Http\Controllers;

use App\Models\Personaje;
use Illuminate\Http\Request;

class PersonajeController extends Controller
{
    // Muestra la lista de personajes del usuario
    public function index()
    {
        // Solo los personajes del usuario autenticado
        $personajes = Personaje::where('usuario_id', auth()->id())->get();

        return view('personajes.index', compact('personajes'));
    }

    // Muestra el formulario para crear un personaje
    public function create()
    {
        return view('personajes.create');
    }

    // Guarda el nuevo personaje en la base de datos
    public function store(Request $request)
    {
        // Validamos que el JSON de datos no esté vacío
        $request->validate([
            'datos' => 'required|array',
            'datos.nombre' => 'required|max:255',
        ]);

        // Creamos el personaje con el usuario actual como dueño
        Personaje::create([
            'usuario_id' => auth()->id(),
            'datos'      => $request->datos,
        ]);

        return redirect()->route('personajes.index');
    }

    // Muestra el detalle de un personaje
    public function show(Personaje $personaje)
    {
        // Solo el dueño puede ver su personaje
        if (auth()->id() !== $personaje->usuario_id) {
            return redirect()->route('personajes.index');
        }

        return view('personajes.show', compact('personaje'));
    }

    // Muestra el formulario para editar un personaje
    public function edit(Personaje $personaje)
    {
        // Solo el dueño puede editar su personaje
        if (auth()->id() !== $personaje->usuario_id) {
            return redirect()->route('personajes.index');
        }

        return view('personajes.edit', compact('personaje'));
    }

    // Guarda los cambios del personaje
    public function update(Request $request, Personaje $personaje)
    {
        // Solo el dueño puede editar su personaje
        if (auth()->id() !== $personaje->usuario_id) {
            return redirect()->route('personajes.index');
        }

        $request->validate([
            'datos' => 'required|array',
            'datos.nombre' => 'required|max:255',
        ]);

        $personaje->update([
            'datos' => $request->datos,
        ]);

        return redirect()->route('personajes.index');
    }

    // Elimina un personaje
    public function destroy(Personaje $personaje)
    {
        // Solo el dueño puede eliminar su personaje
        if (auth()->id() !== $personaje->usuario_id) {
            return redirect()->route('personajes.index');
        }

        $personaje->delete();

        return redirect()->route('personajes.index');
    }
}