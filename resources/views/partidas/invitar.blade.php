@extends('layouts.panel')

@section('titulo', 'Invitar personajes — Forja de Mundos')

@section('contenido')

    <div class="dashboard-cabecera">
        <div>
            <h1 class="dashboard-titulo">Invitar personajes</h1>
            <p class="dashboard-subtitulo">{{ $partida->nombre }}</p>
        </div>
        <div class="dashboard-acciones">
            <a href="{{ route('partidas.show', $partida) }}" class="btn btn-contorno">
                ← Volver a la partida
            </a>
        </div>
    </div>

    {{-- ---- PERSONAJES DISPONIBLES ---- --}}
    <section class="dashboard-seccion">

        <h2 class="dashboard-seccion-titulo">
            Personajes disponibles ({{ $personajesDisponibles->count() }})
        </h2>

        @if ($personajesDisponibles->isEmpty())
            <p class="partidas-vacio">
                No hay personajes disponibles para invitar.
                Todos los personajes ya están en esta partida o no hay ninguno creado todavía.
            </p>
        @else
            <div class="grid">
                @foreach ($personajesDisponibles as $personaje)
                    <div class="tarjeta">
                        @if ($personaje->imagen)
                            <img src="{{ asset('storage/' . $personaje->imagen) }}" class="tarjeta-imagen">
                        @else
                            <img src="{{ asset('img/pj-default.png') }}" class="tarjeta-imagen">
                        @endif
                        <div class="tarjeta-cabecera">
                            <span class="etiqueta etiqueta-jugador">
                                {{ $personaje->datos['clase'] ?? 'Sin clase' }}
                            </span>
                        </div>
                        <h3 class="tarjeta-titulo">
                            {{ $personaje->datos['nombre'] ?? 'Sin nombre' }}
                        </h3>
                        <p class="tarjeta-texto">
                            {{ $personaje->datos['raza'] ?? 'Sin raza' }} ·
                            Nivel {{ $personaje->datos['nivel'] ?? 1 }}
                        </p>
                        <p class="tarjeta-texto">
                            Jugador: {{ $personaje->usuario->name }}
                        </p>
                        <form action="{{ route('partidas.agregarPersonaje', $partida) }}" method="POST">
                            @csrf
                            <input type="hidden" name="personaje_id" value="{{ $personaje->id }}">
                            <button type="submit" class="btn btn-amarillo btn-sm">
                                ➕ Añadir a la partida
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif

    </section>

    {{-- ---- PERSONAJES YA EN LA PARTIDA ---- --}}
    <section class="dashboard-seccion">

        <h2 class="dashboard-seccion-titulo">
            Ya en la partida ({{ $partida->personajes->count() }})
        </h2>

        @if ($partida->personajes->isEmpty())
            <p class="partidas-vacio">Todavía no hay personajes en esta partida.</p>
        @else
            <div class="grid">
                @foreach ($partida->personajes as $personaje)
                    <div class="tarjeta">
                        @if ($personaje->imagen)
                            <img src="{{ asset('storage/' . $personaje->imagen) }}" class="tarjeta-imagen">
                        @else
                            <img src="{{ asset('img/pj-default.png') }}" class="tarjeta-imagen">
                        @endif
                        <div class="tarjeta-cabecera">
                            <span class="etiqueta etiqueta-jugador">
                                {{ $personaje->datos['clase'] ?? 'Sin clase' }}
                            </span>
                        </div>
                        <h3 class="tarjeta-titulo">
                            {{ $personaje->datos['nombre'] ?? 'Sin nombre' }}
                        </h3>
                        <p class="tarjeta-texto">
                            {{ $personaje->datos['raza'] ?? 'Sin raza' }} ·
                            Nivel {{ $personaje->datos['nivel'] ?? 1 }}
                        </p>
                        <p class="tarjeta-texto">
                            Jugador: {{ $personaje->usuario->name }}
                        </p>
                        <form action="{{ route('partidas.quitarPersonaje', $partida) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="personaje_id" value="{{ $personaje->id }}">
                            <button type="submit" class="btn btn-peligro btn-sm"
                                onclick="return confirm('¿Seguro que quieres eliminar este personaje de la partida?')">
                                ✕ Quitar de la partida
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif

    </section>

@endsection