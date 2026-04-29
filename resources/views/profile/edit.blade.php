<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi perfil — Forja de Mundos</title>
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
                <a href="{{ route('personajes.index') }}" class="sidebar-enlace">
                    📜 Mis personajes
                </a>
                <a href="{{ route('profile.edit') }}" class="sidebar-enlace activo">
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

            <div class="dashboard-cabecera">
                <div>
                    <h1 class="dashboard-titulo">Mi perfil</h1>
                    <p class="dashboard-subtitulo">Gestiona tu información personal</p>
                </div>
            </div>

            {{-- Sección 1: Información del perfil --}}
            <div class="perfil-seccion">
                <h2 class="dashboard-seccion-titulo">Información de la cuenta</h2>
                <div class="perfil-tarjeta">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Sección 2: Cambiar contraseña --}}
            <div class="perfil-seccion">
                <h2 class="dashboard-seccion-titulo">Cambiar contraseña</h2>
                <div class="perfil-tarjeta">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Sección 3: Eliminar cuenta --}}
            <div class="perfil-seccion">
                <h2 class="dashboard-seccion-titulo">Zona de peligro</h2>
                <div class="perfil-tarjeta perfil-tarjeta-peligro">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </main>

    </div>{{-- fin .panel --}}

</body>

</html>