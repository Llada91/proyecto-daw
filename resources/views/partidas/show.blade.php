<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $partida->nombre }} — Forja de Mundos</title>
    @vite(['resources/css/app.css'])
</head>
<body>

    <div class="panel">

        {{-- =============================================
             BARRA LATERAL
        ============================================= --}}
        <aside class="sidebar">

            <a href="/" class="sidebar-logo">
                ⚔️ Forja de <span>Mundos</span>
            </a>

            <nav class="sidebar-nav">
                <a href="{{ route('dashboard') }}" class="sidebar-enlace">
                    🏠 Dashboard
                </a>
                <a href="{{ route('partidas.index') }}" class="sidebar-enlace activo">
                    ⚔️ Mis partidas
                </a>
                <a href="{{ route('personajes.index') }}" class="sidebar-enlace">
                    📜 Mis personajes
                </a>
                <a href="{{ route('profile.edit') }}" class="sidebar-enlace">
                    👤 Mi perfil
                </a>
            </nav>

            <form action="{{ route('logout') }}" method="POST" class="sidebar-logout">
                @csrf
                <button type="submit" class="btn btn-contorno btn-bloque">
                    Cerrar sesión
                </button>
            </form>

        </aside>


        {{-- =============================================
             CONTENIDO PRINCIPAL
        ============================================= --}}
        <main class="panel-contenido">

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

                {{-- Solo el director ve los botones --}}
                @if (auth()->id() === $partida->creador_id)
                    <div class="dashboard-acciones">
                        {{-- Botón para invitar personajes --}}
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
                    </div>
                @endif
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

                                {{-- Imagen del personaje si existe --}}
                                @if ($personaje->imagen)
                                    <img src="{{ asset('storage/' . $personaje->imagen) }}" class="tarjeta-imagen">
                                @else
                                    <div class="tarjeta-imagen-placeholder">🧙</div>
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

        </main>

    </div>{{-- fin .panel --}}

</body>
</html>