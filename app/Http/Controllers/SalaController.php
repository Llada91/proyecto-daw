<?php

namespace App\Http\Controllers;

use App\Models\Partida;
use App\Models\Mensaje;
use Illuminate\Http\Request;

class SalaController extends Controller
{
    // Muestra la sala de juego
    public function show(Partida $partida)
    {
        // Mis personajes en esta partida
        $misPersonajes = $partida->personajes
            ->where('usuario_id', auth()->id());

        // Personaje activo — el guardado en sesión o el primero por defecto
        $personajeIdActivo = session('personaje_activo_' . $partida->id);
        if ($personajeIdActivo) {
            $miPersonaje = $misPersonajes->firstWhere('id', $personajeIdActivo);
        } else {
            $miPersonaje = $misPersonajes->first();
        }

        // Últimos 50 mensajes en orden cronológico
        $mensajes = Mensaje::where('partida_id', $partida->id)
            ->with('personaje')
            ->latest()
            ->take(50)
            ->get()
            ->reverse()
            ->values();

        // Todos los personajes de la partida para el panel derecho
        $personajes = $partida->personajes;

        return view('sala.show', compact(
            'partida',
            'miPersonaje',
            'misPersonajes',
            'mensajes',
            'personajes'
        ));
    }

    // Cambia el personaje activo guardándolo en la sesión
    public function elegirPersonaje(Request $request, Partida $partida)
    {
        $request->validate([
            'personaje_id' => 'required|integer',
        ]);

        // Comprobamos que el personaje pertenece al usuario y está en la partida
        $personaje = $partida->personajes
            ->where('usuario_id', auth()->id())
            ->firstWhere('id', $request->personaje_id);

        // Si el personaje no es suyo no hacemos nada
        if (!$personaje) {
            return redirect()->route('sala.show', $partida);
        }

        // Guardamos el personaje activo en la sesión
        session(['personaje_activo_' . $partida->id => $request->personaje_id]);

        return redirect()->route('sala.show', $partida);
    }

    // Guarda un mensaje
    public function enviarMensaje(Request $request, Partida $partida)
    {
        $request->validate([
            'contenido' => 'required|max:500',
        ]);

        $miPersonaje = $this->getPersonajeActivo($partida);

        if (!$miPersonaje) {
            return redirect()->route('sala.show', $partida);
        }

        Mensaje::create([
            'partida_id'   => $partida->id,
            'personaje_id' => $miPersonaje->id,
            'tipo'         => 'mensaje',
            'contenido'    => $request->contenido,
        ]);

        return redirect()->route('sala.show', $partida);
    }

    // Procesa una tirada de dado
    public function tirarDado(Request $request, Partida $partida)
    {
        $request->validate([
            'dado' => 'required|in:4,6,8,10,12,20,100',
        ]);

        $miPersonaje = $this->getPersonajeActivo($partida);

        if (!$miPersonaje) {
            return redirect()->route('sala.show', $partida);
        }

        $resultado = rand(1, $request->dado);

        Mensaje::create([
            'partida_id'   => $partida->id,
            'personaje_id' => $miPersonaje->id,
            'tipo'         => 'tirada',
            'contenido'    => '🎲 d' . $request->dado . ' → ' . $resultado,
        ]);

        return redirect()->route('sala.show', $partida);
    }

    // Función privada para obtener el personaje activo del usuario
    private function getPersonajeActivo(Partida $partida)
    {
        $personajeIdActivo = session('personaje_activo_' . $partida->id);

        $misPersonajes = $partida->personajes
            ->where('usuario_id', auth()->id());

        if ($personajeIdActivo) {
            return $misPersonajes->firstWhere('id', $personajeIdActivo);
        }

        return $misPersonajes->first();
    }
}