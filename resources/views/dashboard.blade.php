<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — Forja de Mundos</title>
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
                <a href="{{ route('dashboard') }}" class="sidebar-enlace activo">
                    🏠 Dashboard
                </a>
                <a href="{{ route('partidas.index') }}" class="sidebar-enlace">
                    ⚔️ Mis partidas
                </a>
                <a href="{{ route('personajes.index') }}" class="sidebar-enlace">
                    📜 Mis personajes
                </a>
                <a href="{{ route('profile.edit') }}" class="sidebar-enlace">
                    👤 Mi perfil
                </a>
            </nav>

            {{-- Cerrar sesión al fondo de la barra --}}
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

            {{-- Saludo al usuario --}}
            <div class="dashboard-cabecera">
                <div>
                    <h1 class="dashboard-titulo">Bienvenido, {{ auth()->user()->name }}</h1>
                    <p class="dashboard-subtitulo">¿Listo para la aventura?</p>
                </div>

                {{-- Acciones rápidas --}}
                <div class="dashboard-acciones">
                    <a href="{{ route('partidas.create') }}"   class="btn btn-morado">⚔️ Nueva partida</a>
                    <a href="{{ route('personajes.create') }}" class="btn btn-contorno">📜 Nuevo personaje</a>
                </div>
            </div>


            {{-- ---- MIS PARTIDAS ---- --}}
            <section class="dashboard-seccion">

                <h2 class="dashboard-seccion-titulo">Mis partidas</h2>

                <div class="grid">

                    {{-- Partidas como director --}}
                    @foreach ($partidasComoDirector as $partida)
                        <div class="tarjeta">
                            @if ($partida->imagen)
                                <img src="{{ asset('storage/' . $partida->imagen) }}" class="tarjeta-imagen">
                            @else
                                <div class="tarjeta-imagen-placeholder">⚔️</div>
                            @endif
                            <div class="tarjeta-cabecera">
                                <span class="etiqueta etiqueta-director">Director</span>
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

                    {{-- Partidas como jugador --}}
                    @foreach ($partidasComoJugador as $partida)
                        <div class="tarjeta">
                            @if ($partida->imagen)
                                <img src="{{ asset('storage/' . $partida->imagen) }}" class="tarjeta-imagen">
                            @else
                                <div class="tarjeta-imagen-placeholder">🛡️</div>
                            @endif
                            <div class="tarjeta-cabecera">
                                <span class="etiqueta etiqueta-jugador">Jugador</span>
                            </div>
                            <h3 class="tarjeta-titulo">{{ $partida->nombre }}</h3>
                            <p class="tarjeta-texto">
                                Director: {{ $partida->creador->name }} ·
                                {{ $partida->personajes->count() }} jugadores
                            </p>
                            <a href="{{ route('partidas.show', $partida) }}" class="btn btn-contorno btn-sm">
                                Entrar
                            </a>
                        </div>
                    @endforeach

                    {{-- Si no hay ninguna partida --}}
                    @if ($partidasComoDirector->isEmpty() && $partidasComoJugador->isEmpty())
                        <p class="partidas-vacio">No tienes ninguna partida todavía.</p>
                    @endif

                    {{-- Tarjeta para crear nueva partida --}}
                    <a href="{{ route('partidas.create') }}" class="tarjeta tarjeta-nueva">
                        <span class="tarjeta-nueva-icono">＋</span>
                        <p>Crear nueva partida</p>
                    </a>

                </div>

            </section>


            {{-- ---- ACTIVIDAD RECIENTE ---- --}}
            {{-- Por ahora muestra las últimas partidas y personajes creados --}}
            <section class="dashboard-seccion">

                <h2 class="dashboard-seccion-titulo">Actividad reciente</h2>

                <div class="actividad-lista">

                    {{-- Últimas partidas creadas --}}
                    @forelse ($partidasComoDirector as $partida)
                        <div class="actividad-fila">
                            <span class="actividad-icono">⚔️</span>
                            <div class="actividad-info">
                                <p class="actividad-texto">
                                    Partida <strong>{{ $partida->nombre }}</strong> creada
                                </p>
                                <p class="actividad-fecha">{{ $partida->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @empty
                        {{-- No mostramos nada si no hay partidas --}}
                    @endforelse

                    {{-- Últimos personajes creados --}}
                    @forelse ($personajes as $personaje)
                        <div class="actividad-fila">
                            <span class="actividad-icono">📜</span>
                            <div class="actividad-info">
                                <p class="actividad-texto">
                                    Personaje <strong>{{ $personaje->datos['nombre'] ?? 'Sin nombre' }}</strong> creado
                                </p>
                                <p class="actividad-fecha">{{ $personaje->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @empty
                        {{-- No mostramos nada si no hay personajes --}}
                    @endforelse

                    {{-- Si no hay nada que mostrar --}}
                    @if ($partidasComoDirector->isEmpty() && $personajes->isEmpty())
                        <p class="partidas-vacio">No hay actividad reciente todavía.</p>
                    @endif

                </div>

            </section>

        </main>

    </div>{{-- fin .panel --}}

</body>
</html>