@extends('layouts.panel')

@section('titulo', 'Mis personajes — Forja de Mundos')

@section('contenido')

    <div class="dashboard-cabecera">
        <div>
            <h1 class="dashboard-titulo">Mis personajes</h1>
            <p class="dashboard-subtitulo">Gestiona tus fichas de personaje</p>
        </div>
        <div class="dashboard-acciones">
            <a href="{{ route('personajes.create') }}" class="btn btn-morado">📜 Nuevo personaje</a>
        </div>
    </div>

    <section class="dashboard-seccion">

        <h2 class="dashboard-seccion-titulo">Tus personajes ({{ $personajes->count() }})</h2>

        @if ($personajes->isEmpty())
            <p class="partidas-vacio">No tienes ningún personaje creado todavía.</p>
        @else
            <div class="grid">
                @foreach ($personajes as $personaje)
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
                        <div class="tarjeta-acciones">
                            <a href="{{ route('personajes.show', $personaje) }}" class="btn btn-morado btn-sm">
                                Ver ficha
                            </a>
                            <a href="{{ route('personajes.edit', $personaje) }}" class="btn btn-contorno btn-sm">
                                Editar
                            </a>
                            <form action="{{ route('personajes.destroy', $personaje) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-peligro btn-sm"
                                    onclick="return confirm('¿Seguro que quieres eliminar este personaje?')">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach

                <a href="{{ route('personajes.create') }}" class="tarjeta tarjeta-nueva">
                    <span class="tarjeta-nueva-icono">＋</span>
                    <p>Crear nuevo personaje</p>
                </a>
            </div>
        @endif

    </section>

@endsection