@extends('layouts.panel')

@section('titulo', 'Mis partidas — Forja de Mundos')

@section('contenido')

    {{-- Cabecera con título y botón de crear --}}
    <div class="dashboard-cabecera">
        <div>
            <h1 class="dashboard-titulo">Mis partidas</h1>
            <p class="dashboard-subtitulo">Gestiona tus partidas como director o jugador</p>
        </div>
        <div class="dashboard-acciones">
            <a href="{{ route('partidas.create') }}" class="btn btn-morado">⚔️ Nueva partida</a>
        </div>
    </div>


    {{-- ---- PARTIDAS COMO DIRECTOR ---- --}}
    <section class="dashboard-seccion">

        <h2 class="dashboard-seccion-titulo">Como director</h2>

        @if ($partidasComoDirector->isEmpty())
            <p class="partidas-vacio">No has creado ninguna partida todavía.</p>
        @else
            <div class="grid">
                @foreach ($partidasComoDirector as $partida)
                    <div class="tarjeta">
                        @if ($partida->imagen)
                            <img src="{{ asset('storage/' . $partida->imagen) }}" class="tarjeta-imagen">
                        @else
                            <img src="{{ asset('img/game-default.png') }}" class="tarjeta-imagen">
                        @endif
                        <div class="tarjeta-cabecera">
                            <span class="etiqueta etiqueta-director">Director</span>
                        </div>
                        <h3 class="tarjeta-titulo">{{ $partida->nombre }}</h3>
                        <p class="tarjeta-texto">{{ $partida->descripcion }}</p>
                        <p class="tarjeta-texto">
                            {{ $partida->personajes->count() }} jugadores ·
                            Creada {{ $partida->created_at->diffForHumans() }}
                        </p>
                        <div class="tarjeta-acciones">
                            <a href="{{ route('partidas.show', $partida) }}" class="btn btn-morado btn-sm">
                                Entrar
                            </a>
                            <a href="{{ route('partidas.edit', $partida) }}" class="btn btn-contorno btn-sm">
                                Editar
                            </a>
                            <form action="{{ route('partidas.destroy', $partida) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-peligro btn-sm"
                                    onclick="return confirm('¿Seguro que quieres eliminar esta partida?')">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach

                {{-- Tarjeta para crear nueva partida --}}
                <a href="{{ route('partidas.create') }}" class="tarjeta tarjeta-nueva">
                    <span class="tarjeta-nueva-icono">＋</span>
                    <p>Crear nueva partida</p>
                </a>
            </div>
        @endif

    </section>


    {{-- ---- PARTIDAS COMO JUGADOR ---- --}}
    <section class="dashboard-seccion">

        <h2 class="dashboard-seccion-titulo">Como jugador</h2>

        @if ($partidasComoJugador->isEmpty())
            <p class="partidas-vacio">No estás participando en ninguna partida todavía.</p>
        @else
            <div class="grid">
                @foreach ($partidasComoJugador as $partida)
                    <div class="tarjeta">
                        @if ($partida->imagen)
                            <img src="{{ asset('storage/' . $partida->imagen) }}" class="tarjeta-imagen">
                        @else
                            <img src="{{ asset('img/game-default.png') }}" class="tarjeta-imagen">
                        @endif
                        <div class="tarjeta-cabecera">
                            <span class="etiqueta etiqueta-jugador">Jugador</span>
                        </div>
                        <h3 class="tarjeta-titulo">{{ $partida->nombre }}</h3>
                        <p class="tarjeta-texto">{{ $partida->descripcion }}</p>
                        <p class="tarjeta-texto">
                            Director: {{ $partida->creador->name }} ·
                            {{ $partida->personajes->count() }} jugadores
                        </p>
                        <div class="tarjeta-acciones">
                            <a href="{{ route('partidas.show', $partida) }}" class="btn btn-contorno btn-sm">
                                Entrar
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </section>

@endsection