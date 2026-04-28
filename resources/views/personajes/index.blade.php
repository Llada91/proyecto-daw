<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis personajes — Forja de Mundos</title>
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
                <a href="{{ route('partidas.index') }}" class="sidebar-enlace">
                    ⚔️ Mis partidas
                </a>
                <a href="{{ route('personajes.index') }}" class="sidebar-enlace activo">
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

            {{-- Cabecera con título y botón de crear --}}
            <div class="dashboard-cabecera">
                <div>
                    <h1 class="dashboard-titulo">Mis personajes</h1>
                    <p class="dashboard-subtitulo">Gestiona tus fichas de personaje</p>
                </div>
                <div class="dashboard-acciones">
                    <a href="{{ route('personajes.create') }}" class="btn btn-morado">📜 Nuevo personaje</a>
                </div>
            </div>


            {{-- ---- LISTA DE PERSONAJES ---- --}}
            <section class="dashboard-seccion">

                <h2 class="dashboard-seccion-titulo">Tus personajes ({{ $personajes->count() }})</h2>

                @if ($personajes->isEmpty())
                    <p class="partidas-vacio">No tienes ningún personaje creado todavía.</p>
                @else
                    <div class="grid">
                        @foreach ($personajes as $personaje)
                            <div class="tarjeta">
                                <div class="tarjeta-cabecera">
                                    <span class="tarjeta-icono">🧙</span>
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
                                    {{-- Formulario para eliminar el personaje --}}
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

                        {{-- Tarjeta para crear nuevo personaje --}}
                        <a href="{{ route('personajes.create') }}" class="tarjeta tarjeta-nueva">
                            <span class="tarjeta-nueva-icono">＋</span>
                            <p>Crear nuevo personaje</p>
                        </a>
                    </div>
                @endif

            </section>

        </main>

    </div>{{-- fin .panel --}}

</body>
</html>