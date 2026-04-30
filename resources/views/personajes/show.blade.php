@extends('layouts.panel')

@section('titulo', ($personaje->datos['nombre'] ?? 'Personaje') . ' — Forja de Mundos')

@section('contenido')

    {{-- Imagen grande del personaje si existe --}}
    @if ($personaje->imagen)
        <img src="{{ asset('storage/' . $personaje->imagen) }}" class="show-imagen">
    @endif

    {{-- Cabecera con nombre y acciones --}}
    <div class="dashboard-cabecera">
        <div>
            <h1 class="dashboard-titulo">
                {{ $personaje->datos['nombre'] ?? 'Sin nombre' }}
            </h1>
            <p class="dashboard-subtitulo">
                {{ $personaje->datos['raza'] ?? 'Sin raza' }} ·
                {{ $personaje->datos['clase'] ?? 'Sin clase' }} ·
                Nivel {{ $personaje->datos['nivel'] ?? 1 }}
            </p>
        </div>
        <div class="dashboard-acciones">
            <a href="{{ route('personajes.edit', $personaje) }}" class="btn btn-morado">
                Editar personaje
            </a>
            <form action="{{ route('personajes.destroy', $personaje) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-peligro"
                    onclick="return confirm('¿Seguro que quieres eliminar este personaje?')">
                    Eliminar
                </button>
            </form>
        </div>
    </div>

    {{-- ---- INFORMACIÓN BÁSICA ---- --}}
    <div class="perfil-seccion">
        <h2 class="dashboard-seccion-titulo">Información básica</h2>
        <div class="perfil-tarjeta">

            <div class="ficha-grid-2">
                <div class="ficha-dato">
                    <span class="ficha-dato-etiqueta">Trasfondo</span>
                    <span class="ficha-dato-valor">{{ $personaje->datos['trasfondo'] ?? '—' }}</span>
                </div>
                <div class="ficha-dato">
                    <span class="ficha-dato-etiqueta">Puntos de vida</span>
                    <span class="ficha-dato-valor">{{ $personaje->datos['puntos_vida'] ?? '—' }}</span>
                </div>
                <div class="ficha-dato">
                    <span class="ficha-dato-etiqueta">Clase de armadura</span>
                    <span class="ficha-dato-valor">{{ $personaje->datos['clase_armadura'] ?? '—' }}</span>
                </div>
                <div class="ficha-dato">
                    <span class="ficha-dato-etiqueta">Jugador</span>
                    <span class="ficha-dato-valor">{{ $personaje->usuario->name }}</span>
                </div>
            </div>

            @if (!empty($personaje->datos['descripcion']))
                <div class="campo" style="margin-top: 1.5rem;">
                    <span class="campo-etiqueta">Historia del personaje</span>
                    <p class="partida-descripcion">{{ $personaje->datos['descripcion'] }}</p>
                </div>
            @endif

        </div>
    </div>

    {{-- ---- CARACTERÍSTICAS ---- --}}
    <div class="perfil-seccion">
        <h2 class="dashboard-seccion-titulo">Características</h2>
        <div class="perfil-tarjeta">
            <div class="ficha-grid-3">
                <div class="ficha-stat">
                    <span class="ficha-stat-valor">{{ $personaje->datos['fuerza'] ?? 10 }}</span>
                    <span class="ficha-stat-nombre">Fuerza</span>
                </div>
                <div class="ficha-stat">
                    <span class="ficha-stat-valor">{{ $personaje->datos['destreza'] ?? 10 }}</span>
                    <span class="ficha-stat-nombre">Destreza</span>
                </div>
                <div class="ficha-stat">
                    <span class="ficha-stat-valor">{{ $personaje->datos['constitucion'] ?? 10 }}</span>
                    <span class="ficha-stat-nombre">Constitución</span>
                </div>
                <div class="ficha-stat">
                    <span class="ficha-stat-valor">{{ $personaje->datos['inteligencia'] ?? 10 }}</span>
                    <span class="ficha-stat-nombre">Inteligencia</span>
                </div>
                <div class="ficha-stat">
                    <span class="ficha-stat-valor">{{ $personaje->datos['sabiduria'] ?? 10 }}</span>
                    <span class="ficha-stat-nombre">Sabiduría</span>
                </div>
                <div class="ficha-stat">
                    <span class="ficha-stat-valor">{{ $personaje->datos['carisma'] ?? 10 }}</span>
                    <span class="ficha-stat-nombre">Carisma</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ---- PARTIDAS ---- --}}
    <div class="perfil-seccion">
        <h2 class="dashboard-seccion-titulo">Partidas en las que participa</h2>
        <div class="perfil-tarjeta">
            @if ($personaje->partidas->isEmpty())
                <p class="partidas-vacio">Este personaje no está en ninguna partida todavía.</p>
            @else
                @foreach ($personaje->partidas as $partida)
                    <div class="actividad-fila">
                        <span class="actividad-icono">⚔️</span>
                        <div class="actividad-info">
                            <p class="actividad-texto">{{ $partida->nombre }}</p>
                            <p class="actividad-fecha">Director: {{ $partida->creador->name }}</p>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

@endsection