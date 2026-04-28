<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — Plataforma de Rol Online</title>
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

                    {{-- Tarjetas de ejemplo --}}
                    <div class="tarjeta">
                        <div class="tarjeta-cabecera">
                            <span class="tarjeta-icono">⚔️</span>
                            <span class="etiqueta etiqueta-director">Director</span>
                        </div>
                        <h3 class="tarjeta-titulo">La Mina Perdida</h3>
                        <p class="tarjeta-texto">3 jugadores · Última sesión hace 2 días</p>
                        <a href="#" class="btn btn-morado btn-sm">Entrar</a>
                    </div>

                    <div class="tarjeta">
                        <div class="tarjeta-cabecera">
                            <span class="tarjeta-icono">🛡️</span>
                            <span class="etiqueta etiqueta-jugador">Jugador</span>
                        </div>
                        <h3 class="tarjeta-titulo">El Señor de las Sombras</h3>
                        <p class="tarjeta-texto">5 jugadores · Última sesión hace 5 días</p>
                        <a href="#" class="btn btn-contorno btn-sm">Entrar</a>
                    </div>

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

                    <div class="actividad-fila">
                        <span class="actividad-icono">🎲</span>
                        <div class="actividad-info">
                            <p class="actividad-texto">Tiraste 1d20 — resultado: <strong>18</strong></p>
                            <p class="actividad-fecha">Hace 10 minutos · La Mina Perdida</p>
                        </div>
                    </div>

                    <div class="actividad-fila">
                        <span class="actividad-icono">⚔️</span>
                        <div class="actividad-info">
                            <p class="actividad-texto">Sesión iniciada en <strong>La Mina Perdida</strong></p>
                            <p class="actividad-fecha">Hace 2 días</p>
                        </div>
                    </div>

                    <div class="actividad-fila">
                        <span class="actividad-icono">📜</span>
                        <div class="actividad-info">
                            <p class="actividad-texto">Personaje <strong>Thorn el Gris</strong> actualizado</p>
                            <p class="actividad-fecha">Hace 3 días</p>
                        </div>
                    </div>

                    <div class="actividad-fila">
                        <span class="actividad-icono">🛡️</span>
                        <div class="actividad-info">
                            <p class="actividad-texto">Te uniste a <strong>El Señor de las Sombras</strong></p>
                            <p class="actividad-fecha">Hace 5 días</p>
                        </div>
                    </div>

                </div>

            </section>

        </main>

    </div>{{-- fin .panel --}}

</body>
</html>