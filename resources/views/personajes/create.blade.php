<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo personaje — Forja de Mundos</title>
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

            <div class="dashboard-cabecera">
                <div>
                    <h1 class="dashboard-titulo">Nuevo personaje</h1>
                    <p class="dashboard-subtitulo">Crea tu ficha de personaje</p>
                </div>
            </div>

            {{-- Mensajes de error --}}
            @if ($errors->any())
                <div class="form-error">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('personajes.store') }}">
                @csrf

                {{-- ---- INFORMACIÓN BÁSICA ---- --}}
                <div class="perfil-seccion">
                    <h2 class="dashboard-seccion-titulo">Información básica</h2>
                    <div class="perfil-tarjeta">

                        <div class="campo">
                            <label for="nombre" class="campo-etiqueta">Nombre del personaje</label>
                            <input
                                id="nombre"
                                type="text"
                                name="datos[nombre]"
                                value="{{ old('datos.nombre') }}"
                                class="campo-input"
                                placeholder="Thorn el Gris..."
                                required
                                autofocus
                            >
                        </div>

                        <div class="ficha-grid-2">
                            <div class="campo">
                                <label for="raza" class="campo-etiqueta">Raza</label>
                                <input
                                    id="raza"
                                    type="text"
                                    name="datos[raza]"
                                    value="{{ old('datos.raza') }}"
                                    class="campo-input"
                                    placeholder="Humano, Elfo, Enano..."
                                >
                            </div>
                            <div class="campo">
                                <label for="clase" class="campo-etiqueta">Clase</label>
                                <input
                                    id="clase"
                                    type="text"
                                    name="datos[clase]"
                                    value="{{ old('datos.clase') }}"
                                    class="campo-input"
                                    placeholder="Guerrero, Mago, Pícaro..."
                                >
                            </div>
                        </div>

                        <div class="ficha-grid-2">
                            <div class="campo">
                                <label for="nivel" class="campo-etiqueta">Nivel</label>
                                <input
                                    id="nivel"
                                    type="number"
                                    name="datos[nivel]"
                                    value="{{ old('datos.nivel', 1) }}"
                                    class="campo-input"
                                    min="1"
                                    max="20"
                                >
                            </div>
                            <div class="campo">
                                <label for="trasfondo" class="campo-etiqueta">Trasfondo</label>
                                <input
                                    id="trasfondo"
                                    type="text"
                                    name="datos[trasfondo]"
                                    value="{{ old('datos.trasfondo') }}"
                                    class="campo-input"
                                    placeholder="Noble, Soldado, Sabio..."
                                >
                            </div>
                        </div>

                        <div class="ficha-grid-2">
                            <div class="campo">
                                <label for="puntos_vida" class="campo-etiqueta">Puntos de vida</label>
                                <input
                                    id="puntos_vida"
                                    type="number"
                                    name="datos[puntos_vida]"
                                    value="{{ old('datos.puntos_vida', 10) }}"
                                    class="campo-input"
                                    min="1"
                                >
                            </div>
                            <div class="campo">
                                <label for="clase_armadura" class="campo-etiqueta">Clase de armadura</label>
                                <input
                                    id="clase_armadura"
                                    type="number"
                                    name="datos[clase_armadura]"
                                    value="{{ old('datos.clase_armadura', 10) }}"
                                    class="campo-input"
                                    min="1"
                                >
                            </div>
                        </div>

                        <div class="campo">
                            <label for="descripcion" class="campo-etiqueta">Historia del personaje</label>
                            <textarea
                                id="descripcion"
                                name="datos[descripcion]"
                                class="campo-input campo-textarea"
                                placeholder="Cuenta la historia de tu personaje..."
                            >{{ old('datos.descripcion') }}</textarea>
                        </div>

                    </div>
                </div>


                {{-- ---- CARACTERÍSTICAS ---- --}}
                <div class="perfil-seccion">
                    <h2 class="dashboard-seccion-titulo">Características</h2>
                    <div class="perfil-tarjeta">

                        <div class="ficha-grid-3">

                            <div class="campo">
                                <label for="fuerza" class="campo-etiqueta">Fuerza</label>
                                <input
                                    id="fuerza"
                                    type="number"
                                    name="datos[fuerza]"
                                    value="{{ old('datos.fuerza', 10) }}"
                                    class="campo-input campo-stat"
                                    min="1" max="20"
                                >
                            </div>

                            <div class="campo">
                                <label for="destreza" class="campo-etiqueta">Destreza</label>
                                <input
                                    id="destreza"
                                    type="number"
                                    name="datos[destreza]"
                                    value="{{ old('datos.destreza', 10) }}"
                                    class="campo-input campo-stat"
                                    min="1" max="20"
                                >
                            </div>

                            <div class="campo">
                                <label for="constitucion" class="campo-etiqueta">Constitución</label>
                                <input
                                    id="constitucion"
                                    type="number"
                                    name="datos[constitucion]"
                                    value="{{ old('datos.constitucion', 10) }}"
                                    class="campo-input campo-stat"
                                    min="1" max="20"
                                >
                            </div>

                            <div class="campo">
                                <label for="inteligencia" class="campo-etiqueta">Inteligencia</label>
                                <input
                                    id="inteligencia"
                                    type="number"
                                    name="datos[inteligencia]"
                                    value="{{ old('datos.inteligencia', 10) }}"
                                    class="campo-input campo-stat"
                                    min="1" max="20"
                                >
                            </div>

                            <div class="campo">
                                <label for="sabiduria" class="campo-etiqueta">Sabiduría</label>
                                <input
                                    id="sabiduria"
                                    type="number"
                                    name="datos[sabiduria]"
                                    value="{{ old('datos.sabiduria', 10) }}"
                                    class="campo-input campo-stat"
                                    min="1" max="20"
                                >
                            </div>

                            <div class="campo">
                                <label for="carisma" class="campo-etiqueta">Carisma</label>
                                <input
                                    id="carisma"
                                    type="number"
                                    name="datos[carisma]"
                                    value="{{ old('datos.carisma', 10) }}"
                                    class="campo-input campo-stat"
                                    min="1" max="20"
                                >
                            </div>

                        </div>
                    </div>
                </div>


                {{-- ---- BOTONES ---- --}}
                <div class="tarjeta-acciones">
                    <button type="submit" class="btn btn-morado">
                        Crear personaje
                    </button>
                    <a href="{{ route('personajes.index') }}" class="btn btn-contorno">
                        Cancelar
                    </a>
                </div>

            </form>

        </main>

    </div>{{-- fin .panel --}}

</body>
</html>