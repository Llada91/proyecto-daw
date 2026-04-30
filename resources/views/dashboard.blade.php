@extends('layouts.panel')

@section('titulo', 'Dashboard — Forja de Mundos')

@section('contenido')

    {{-- Saludo al usuario --}}
    <div class="dashboard-cabecera">
        <div>
            <h1 class="dashboard-titulo">Bienvenido, {{ auth()->user()->name }}</h1>
            <p class="dashboard-subtitulo">¿Listo para la aventura?</p>
        </div>
        <div class="dashboard-acciones">
            <a href="{{ route('partidas.create') }}"   class="btn btn-morado">⚔️ Nueva partida</a>
            <a href="{{ route('personajes.create') }}" class="btn btn-contorno">📜 Nuevo personaje</a>
        </div>
    </div>


    {{-- ---- MIS PARTIDAS ---- --}}
    <section class="dashboard-seccion">

        <h2 class="dashboard-seccion-titulo">Mis partidas</h2>

        <div class="grid">

            @php
                $todasLasPartidas = $ultimasPartidas ?? collect();
            @endphp

            @foreach ($ultimasPartidas as $partida)
                <div class="tarjeta">
                    @if ($partida->imagen)
                        <img src="{{ asset('storage/' . $partida->imagen) }}" class="tarjeta-imagen">
                    @else
                        <img src="{{ asset('img/game-default.png') }}" class="tarjeta-imagen">
                    @endif
                    <div class="tarjeta-cabecera">
                        @if ($partida->creador_id === auth()->id())
                            <span class="etiqueta etiqueta-director">Director</span>
                        @else
                            <span class="etiqueta etiqueta-jugador">Jugador</span>
                        @endif
                    </div>
                    <h3 class="tarjeta-titulo">{{ $partida->nombre }}</h3>
                    <p class="tarjeta-texto">
                        {{ $partida->personajes->count() }} jugadores ·
                        {{ $partida->created_at->diffForHumans() }}
                    </p>
                    <a href="{{ route('partidas.show', $partida) }}" class="btn btn-morado btn-sm">
                        Entrar
                    </a>
                </div>
            @endforeach

            {{-- Tarjeta para crear nueva partida --}}
            <a href="{{ route('partidas.create') }}" class="tarjeta tarjeta-nueva">
                <span class="tarjeta-nueva-icono">＋</span>
                <p>Crear nueva partida</p>
            </a>

        </div>

    </section>


    {{-- ---- ACTIVIDAD RECIENTE ---- --}}
    <section class="dashboard-seccion">

        <h2 class="dashboard-seccion-titulo">Actividad reciente</h2>

        <div class="actividad-lista">

            @if ($actividad->isEmpty())
                <p class="partidas-vacio">No hay actividad reciente todavía.</p>
            @else
                @foreach ($actividad as $elemento)
                    <div class="actividad-fila">
                        <span class="actividad-icono">
                            {{ $elemento->tipo_actividad === 'partida' ? '⚔️' : '📜' }}
                        </span>
                        <div class="actividad-info">
                            @if ($elemento->tipo_actividad === 'partida')
                                <p class="actividad-texto">
                                    Partida <strong>{{ $elemento->nombre }}</strong> creada
                                </p>
                            @else
                                <p class="actividad-texto">
                                    Personaje <strong>{{ $elemento->datos['nombre'] ?? 'Sin nombre' }}</strong> creado
                                </p>
                            @endif
                            <p class="actividad-fecha">{{ $elemento->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>

    </section>

@endsection