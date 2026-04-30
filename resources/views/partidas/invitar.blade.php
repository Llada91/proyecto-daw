<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitar personajes — {{ $partida->nombre }}</title>
    @vite(['resources/css/app.css'])
</head>

<body>

    <div class="panel">

        {{-- BARRA LATERAL --}}
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


        {{-- CONTENIDO PRINCIPAL --}}
        <main class="panel-contenido">

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

                        {{-- Imagen del personaje --}}
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

                        {{-- Formulario para añadir el personaje a la partida --}}
                        <form action="{{ route('partidas.agregarPersonaje', $partida) }}" method="POST">
                            @csrf
                            {{-- Enviamos el id del personaje --}}
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

                        {{-- Formulario para eliminar el personaje de la partida --}}
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

        </main>

    </div>

</body>

</html>