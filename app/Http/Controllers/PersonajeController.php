<?php

namespace App\Http\Controllers;

use App\Models\Personaje;
use Illuminate\Http\Request;

class PersonajeController extends Controller
{
    // Muestra la lista de personajes del usuario
    public function index()
    {
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
        $request->validate([
            'datos'        => 'required|array',
            'datos.nombre' => 'required|max:255',
            'imagen'       => 'nullable|image|max:2048',
        ]);

        // Si se subió una imagen la guardamos en storage/app/public/personajes
        $rutaImagen = null;
        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('personajes', 'public');
        }

        Personaje::create([
            'usuario_id' => auth()->id(),
            'datos'      => $request->datos,
            'imagen'     => $rutaImagen,
        ]);

        return redirect()->route('personajes.index');
    }

    // Muestra el detalle de un personaje
    public function show(Personaje $personaje)
    {
        if (auth()->id() !== $personaje->usuario_id) {
            return redirect()->route('personajes.index');
        }

        return view('personajes.show', compact('personaje'));
    }

    // Muestra el formulario para editar un personaje
    public function edit(Personaje $personaje)
    {
        if (auth()->id() !== $personaje->usuario_id) {
            return redirect()->route('personajes.index');
        }

        return view('personajes.edit', compact('personaje'));
    }

    // Guarda los cambios del personaje
    public function update(Request $request, Personaje $personaje)
    {
        if (auth()->id() !== $personaje->usuario_id) {
            return redirect()->route('personajes.index');
        }

        $request->validate([
            'datos'        => 'required|array',
            'datos.nombre' => 'required|max:255',
            'imagen'       => 'nullable|image|max:2048',
        ]);

        // Si se subió una imagen nueva la guardamos y borramos la anterior
        if ($request->hasFile('imagen')) {
            if ($personaje->imagen) {
                \Storage::disk('public')->delete($personaje->imagen);
            }
            $personaje->imagen = $request->file('imagen')->store('personajes', 'public');
        }

        $personaje->datos = $request->datos;
        $personaje->save();

        return redirect()->route('personajes.index');
    }

    // Elimina un personaje
    public function destroy(Personaje $personaje)
    {
        if (auth()->id() !== $personaje->usuario_id) {
            return redirect()->route('personajes.index');
        }

        // Borramos la imagen si existía
        if ($personaje->imagen) {
            \Storage::disk('public')->delete($personaje->imagen);
        }

        $personaje->delete();

        return redirect()->route('personajes.index');
    }
}