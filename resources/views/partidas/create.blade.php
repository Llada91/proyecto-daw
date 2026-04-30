<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva partida — Forja de Mundos</title>
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

            <div class="dashboard-cabecera">
                <div>
                    <h1 class="dashboard-titulo">Nueva partida</h1>
                    <p class="dashboard-subtitulo">Crea una nueva partida como director de juego</p>
                </div>
            </div>

            <div class="perfil-seccion">
                <div class="perfil-tarjeta">

                    {{-- Mensajes de error --}}
                    @if ($errors->any())
                    <div class="form-error">
                        {{ $errors->first() }}
                    </div>
                    @endif

                    {{-- Formulario de crear partida --}}
                    <form method="POST" action="{{ route('partidas.store') }}" enctype="multipart/form-data">
                        @csrf

                        {{-- Nombre --}}
                        <div class="campo">
                            <label for="nombre" class="campo-etiqueta">Nombre de la partida</label>
                            <input
                                id="nombre"
                                type="text"
                                name="nombre"
                                value="{{ old('nombre') }}"
                                class="campo-input"
                                placeholder="La Mina Perdida..."
                                required
                                autofocus>
                            @error('nombre')
                            <span class="campo-error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Descripción --}}
                        <div class="campo">
                            <label for="descripcion" class="campo-etiqueta">Descripción</label>
                            <textarea
                                id="descripcion"
                                name="descripcion"
                                class="campo-input campo-textarea"
                                placeholder="Describe de qué trata la partida...">{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                            <span class="campo-error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Imagen de portada --}}
                        <div class="campo">
                            <label for="imagen" class="campo-etiqueta">Imagen de portada</label>
                            <input
                                id="imagen"
                                type="file"
                                name="imagen"
                                class="campo-input campo-file"
                                accept="image/*">
                            @error('imagen')
                            <span class="campo-error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Botones --}}
                        <div class="tarjeta-acciones">
                            <button type="submit" class="btn btn-morado">
                                Crear partida
                            </button>
                            <a href="{{ route('partidas.index') }}" class="btn btn-contorno">
                                Cancelar
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </main>

    </div>{{-- fin .panel --}}

</body>

</html>