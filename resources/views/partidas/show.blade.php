@extends('layouts.panel')

@section('titulo', $partida->nombre . ' — Forja de Mundos')

@section('contenido')

    {{-- Imagen de portada grande si existe --}}
    @if ($partida->imagen)
        <img src="{{ asset('storage/' . $partida->imagen) }}" class="show-imagen">
    @endif

    {{-- Cabecera con nombre y acciones --}}
    <div class="dashboard-cabecera">
        <div>
            <h1 class="dashboard-titulo">{{ $partida->nombre }}</h1>
            <p class="dashboard-subtitulo">
                Director: {{ $partida->creador->name }} ·
                Creada {{ $partida->created_at->diffForHumans() }}
            </p>
        </div>

        <div class="dashboard-acciones">

            {{-- Botón para entrar en la sala — visible para todos --}}
            <a href="{{ route('sala.show', $partida) }}" class="btn btn-morado">
                ⚔️ Entrar en partida
            </a>

            {{-- Solo el director ve estos botones --}}
            @if (auth()->id() === $partida->creador_id)
                <a href="{{ route('partidas.invitar', $partida) }}" class="btn btn-amarillo">
                    ➕ Invitar personajes
                </a>
                <a href="{{ route('partidas.edit', $partida) }}" class="btn btn-contorno">
                    Editar partida
                </a>
                <form action="{{ route('partidas.destroy', $partida) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-peligro"
                        onclick="return confirm('¿Seguro que quieres eliminar esta partida?')">
                        Eliminar partida
                    </button>
                </form>
            @endif

        </div>
    </div>

    {{-- ---- DESCRIPCIÓN ---- --}}
    <section class="dashboard-seccion">
        <h2 class="dashboard-seccion-titulo">Descripción</h2>
        <div class="perfil-tarjeta">
            <p class="partida-descripcion">
                {{ $partida->descripcion ?? 'Esta partida no tiene descripción.' }}
            </p>
        </div>
    </section>

    {{-- ---- JUGADORES ---- --}}
    <section class="dashboard-seccion">
        <h2 class="dashboard-seccion-titulo">
            Jugadores ({{ $partida->personajes->count() }})
        </h2>

        @if ($partida->personajes->isEmpty())
            <p class="partidas-vacio">No hay jugadores en esta partida todavía.</p>
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
                    </div>
                @endforeach
            </div>
        @endif
    </section>

@endsection