<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio — Plataforma de Rol Online</title>
    @vite(['resources/css/app.css'])
</head>

<body>

    {{-- CABECERA --}}
    <header class="cabecera">

        <a href="/" class="cabecera-logo">
            Forja de <span>Mundos</span>
        </a>

        <nav class="cabecera-nav">
            <a href="#funciones">Funciones</a>
        </nav>

        <div class="cabecera-acciones">
            <a href="{{ route('login') }}" class="btn btn-contorno">Entrar</a>
            <a href="{{ route('register') }}" class="btn btn-morado">Registrarse</a>
        </div>

    </header>


    <main>

        {{-- HERO --}}
        <section class="hero">

            <p class="hero-etiqueta">Plataforma de rol de mesa online</p>

            <h1 class="hero-titulo">
                Tu mesa<br>
                <span>Sin límites</span>
            </h1>

            <p class="hero-descripcion">
                Gestiona tus partidas desde el navegador. Fichas, dados, mapas y más — todo en español.
            </p>

            <div class="hero-acciones">
                <a href="{{ route('register') }}" class="btn btn-amarillo">Empezar gratis</a>
                <a href="{{ route('login') }}" class="btn btn-contorno">Ya tengo cuenta</a>
            </div>

        </section>


        {{-- FUNCIONES — Grid de 3 columnas --}}
        <div class="seccion-wrapper"></div>
        <section class="seccion" id="funciones">

            <h2 class="seccion-titulo">¿Qué puedes hacer?</h2>
            <p class="seccion-subtitulo">Todo lo que necesitas para jugar online</p>

            <div class="grid-tarjetas">

                <div class="tarjeta">
                    <div class="tarjeta-icono">📜</div>
                    <h3 class="tarjeta-titulo">Fichas de personaje</h3>
                    <p class="tarjeta-texto">Crea y edita fichas digitales. Se guardan automáticamente y puedes consultarlas en cualquier momento.</p>
                </div>

                <div class="tarjeta">
                    <div class="tarjeta-icono">🗺️</div>
                    <h3 class="tarjeta-titulo">Mapas interactivos</h3>
                    <p class="tarjeta-texto">Tablero compartido con fichas y marcadores para situar a los personajes durante la sesión.</p>
                </div>

                <div class="tarjeta">
                    <div class="tarjeta-icono">⚔️</div>
                    <h3 class="tarjeta-titulo">Gestión de partidas</h3>
                    <p class="tarjeta-texto">El director crea partidas, gestiona jugadores y controla los turnos desde un panel sencillo.</p>
                </div>

            </div>

        </section>

    </main>

    {{-- PIE DE PÁGINA --}}
    <footer class="pie">

        <div class="pie-logo">Forja de <span>Mundos</span></div>

        <p class="pie-texto">Proyecto académico · 2º DAW · Cristian Llada Álvarez</p>

        <nav class="pie-enlaces">
            <a href="{{ route('login') }}">Entrar</a>
            <a href="{{ route('register') }}">Registrarse</a>
        </nav>

    </footer>

</body>

</html>