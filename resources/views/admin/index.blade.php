@extends('layouts.panel')

@section('titulo', 'Administración — Forja de Mundos')

@section('contenido')

    <div class="dashboard-cabecera">
        <div>
            <h1 class="dashboard-titulo">Panel de administración</h1>
            <p class="dashboard-subtitulo">Gestión global del sistema</p>
        </div>
    </div>


    {{-- ---- ESTADÍSTICAS ---- --}}
    <section class="dashboard-seccion">

        <h2 class="dashboard-seccion-titulo">Estadísticas generales</h2>

        <div class="grid">
            <div class="tarjeta">
                <div class="tarjeta-icono">👥</div>
                <h3 class="tarjeta-titulo">Usuarios registrados</h3>
                <p class="admin-stat">{{ $totalUsuarios }}</p>
            </div>
            <div class="tarjeta">
                <div class="tarjeta-icono">⚔️</div>
                <h3 class="tarjeta-titulo">Partidas creadas</h3>
                <p class="admin-stat">{{ $totalPartidas }}</p>
            </div>
            <div class="tarjeta">
                <div class="tarjeta-icono">📜</div>
                <h3 class="tarjeta-titulo">Personajes creados</h3>
                <p class="admin-stat">{{ $totalPersonajes }}</p>
            </div>
        </div>

    </section>


    {{-- ---- USUARIOS ---- --}}
    <section class="dashboard-seccion">

        <h2 class="dashboard-seccion-titulo">Usuarios ({{ $usuarios->count() }})</h2>

        <div class="admin-tabla">
            <div class="admin-tabla-cabecera">
                <span>Nombre</span>
                <span>Email</span>
                <span>Rol</span>
                <span>Registro</span>
                <span>Acción</span>
            </div>

            @foreach ($usuarios as $usuario)

                {{-- Fila del usuario --}}
                <div class="admin-tabla-fila">
                    <span class="admin-tabla-nombre">{{ $usuario->name }}</span>
                    <span class="admin-tabla-email">{{ $usuario->email }}</span>
                    <span>
                        @if ($usuario->rol === 'admin')
                            <span class="etiqueta etiqueta-director">Admin</span>
                        @else
                            <span class="etiqueta etiqueta-jugador">Usuario</span>
                        @endif
                    </span>
                    <span class="admin-tabla-fecha">
                        {{ $usuario->created_at->format('d/m/Y') }}
                    </span>
                    <span>
                        @if ($usuario->id !== auth()->id())
                            <form action="{{ route('admin.eliminarUsuario', $usuario) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-peligro btn-sm"
                                    onclick="return confirm('¿Seguro que quieres eliminar a {{ $usuario->name }}?')">
                                    Eliminar
                                </button>
                            </form>
                        @else
                            <span class="admin-tabla-yo">Tú</span>
                        @endif
                    </span>
                </div>

                {{-- Personajes del usuario — se despliegan al hacer click --}}
                @if ($usuario->personajes->count() > 0)
                    <div class="admin-tabla-personajes">
                        <details>
                            <summary class="admin-tabla-personajes-titulo">
                                📜 Ver personajes de {{ $usuario->name }}
                                ({{ $usuario->personajes->count() }})
                            </summary>

                            <div class="admin-tabla-personajes-lista">
                                @foreach ($usuario->personajes as $personaje)
                                    <div class="admin-tabla-personaje-fila">
                                        <span class="admin-tabla-nombre">
                                            {{ $personaje->datos['nombre'] ?? 'Sin nombre' }}
                                        </span>
                                        <span>{{ $personaje->datos['raza'] ?? '—' }}</span>
                                        <span>{{ $personaje->datos['clase'] ?? '—' }}</span>
                                        <span>Nv {{ $personaje->datos['nivel'] ?? 1 }}</span>
                                        <span class="tarjeta-acciones">
                                            {{-- Editar lleva a la vista normal de editar personaje --}}
                                            <a href="{{ route('personajes.edit', $personaje) }}" class="btn btn-contorno btn-sm">
                                                Editar
                                            </a>
                                            {{-- Eliminar borra el personaje --}}
                                            <form action="{{ route('admin.eliminarPersonaje', $personaje) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-peligro btn-sm"
                                                    onclick="return confirm('¿Seguro que quieres eliminar a {{ $personaje->datos['nombre'] ?? 'este personaje' }}?')">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </span>
                                    </div>
                                @endforeach
                            </div>

                        </details>
                    </div>
                @endif

            @endforeach

        </div>

    </section>


    {{-- ---- PARTIDAS ---- --}}
    <section class="dashboard-seccion">

        <h2 class="dashboard-seccion-titulo">Partidas ({{ $partidas->count() }})</h2>

        <div class="admin-tabla">
            <div class="admin-tabla-cabecera">
                <span>Nombre</span>
                <span>Director</span>
                <span>Jugadores</span>
                <span>Creada</span>
                <span>Acción</span>
            </div>

            @foreach ($partidas as $partida)
                <div class="admin-tabla-fila">
                    <span class="admin-tabla-nombre">{{ $partida->nombre }}</span>
                    <span>{{ $partida->creador->name }}</span>
                    <span>{{ $partida->personajes->count() }}</span>
                    <span class="admin-tabla-fecha">
                        {{ $partida->created_at->format('d/m/Y') }}
                    </span>
                    <span>
                        <form action="{{ route('admin.eliminarPartida', $partida) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-peligro btn-sm"
                                onclick="return confirm('¿Seguro que quieres eliminar la partida {{ $partida->nombre }}?')">
                                Eliminar
                            </button>
                        </form>
                    </span>
                </div>
            @endforeach

        </div>

    </section>

@endsection