<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Forja de Mundos')</title>
    @vite(['resources/css/app.css'])
</head>
<body>

    <div class="panel">

        {{-- =============================================
             BARRA LATERAL — se define aquí una sola vez
        ============================================= --}}
        <aside class="sidebar">

<a href="{{ route('dashboard') }}" class="sidebar-logo">
    ⚔️ Forja de <span>Mundos</span>
</a>

            <nav class="sidebar-nav">
                <a href="{{ route('dashboard') }}"
                   class="sidebar-enlace {{ request()->routeIs('dashboard') ? 'activo' : '' }}">
                    🏠 Dashboard
                </a>
                <a href="{{ route('partidas.index') }}"
                   class="sidebar-enlace {{ request()->routeIs('partidas.*') ? 'activo' : '' }}">
                    ⚔️ Mis partidas
                </a>
                <a href="{{ route('personajes.index') }}"
                   class="sidebar-enlace {{ request()->routeIs('personajes.*') ? 'activo' : '' }}">
                    📜 Mis personajes
                </a>
                <a href="{{ route('profile.edit') }}"
                   class="sidebar-enlace {{ request()->routeIs('profile.*') ? 'activo' : '' }}">
                    👤 Mi perfil
                </a>

                {{-- Solo los administradores ven este enlace --}}
                @if (auth()->user()->rol === 'admin')
                    <a href="{{ route('admin.index') }}"
                       class="sidebar-enlace {{ request()->routeIs('admin.*') ? 'activo' : '' }}">
                        ⚙️ Administración
                    </a>
                @endif
            </nav>

            <form action="{{ route('logout') }}" method="POST" class="sidebar-logout">
                @csrf
                <button type="submit" class="btn btn-contorno btn-bloque">
                    Cerrar sesión
                </button>
            </form>

        </aside>


        {{-- =============================================
             CONTENIDO — cada vista define su propio contenido
        ============================================= --}}
        <main class="panel-contenido">
            @yield('contenido')
        </main>

    </div>

</body>
</html>