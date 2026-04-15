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
            ⚔️ Forja de <span>Mundos</span>
        </a>

        <nav class="cabecera-nav">
            <a href="#funciones">Funciones</a>
            <a href="#perfiles">Perfiles</a>
        </nav>

        <div class="cabecera-acciones">
            <a href="{{ route('login') }}"    class="btn btn-contorno">Entrar</a>
            <a href="{{ route('register') }}" class="btn btn-morado">Registrarse</a>
        </div>

    </header>


    <main>

        {{-- HERO --}}
        <section class="hero">

            <p class="hero-etiqueta">Plataforma de rol de mesa online</p>

            <h1 class="hero-titulo">
                Tu mesa.<br>
                <span>Sin límites.</span>
            </h1>

            <p class="hero-descripcion">
                Gestiona tus partidas desde el navegador. Fichas, dados, mapas y más — todo en español.
            </p>

            <div class="hero-acciones">
                <a href="{{ route('register') }}" class="btn btn-amarillo">⚔️ Empezar gratis</a>
                <a href="{{ route('login') }}"    class="btn btn-contorno">Ya tengo cuenta</a>
            </div>

        </section>


        {{-- FUNCIONES — Grid de 3 columnas --}}
        <section class="seccion" id="funciones">

            <h2 class="seccion-titulo">¿Qué puedes hacer?</h2>
            <p class="seccion-subtitulo">Todo lo que necesitas para jugar online</p>

            <div class="grid">

                <div class="tarjeta">
                    <div class="tarjeta-icono">🎲</div>
                    <h3 class="tarjeta-titulo">Tiradas de dados</h3>
                    <p class="tarjeta-texto">Lanza dados automáticamente. El resultado es visible para todos los jugadores de la partida.</p>
                </div>

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

                <div class="tarjeta">
                    <div class="tarjeta-icono">👤</div>
                    <h3 class="tarjeta-titulo">Cuentas de usuario</h3>
                    <p class="tarjeta-texto">Registro seguro con cifrado de contraseñas. Perfil propio con tus personajes y partidas.</p>
                </div>

                <div class="tarjeta">
                    <div class="tarjeta-icono">🌐</div>
                    <h3 class="tarjeta-titulo">100% en español</h3>
                    <p class="tarjeta-texto">Interfaz completamente en español, pensada para la comunidad hispanohablante.</p>
                </div>

            </div>

        </section>


        {{-- PERFILES — Grid de 3 columnas --}}
        <section class="seccion" id="perfiles">

            <h2 class="seccion-titulo">¿Para quién es?</h2>
            <p class="seccion-subtitulo">Tres tipos de usuario, una sola plataforma</p>

            <div class="grid">

                <div class="tarjeta">
                    <div class="tarjeta-icono">🧙</div>
                    <h3 class="tarjeta-titulo">Director de juego</h3>
                    <p class="tarjeta-texto">Crea y gestiona partidas, controla turnos, administra jugadores y lleva el hilo de la historia.</p>
                </div>

                <div class="tarjeta">
                    <div class="tarjeta-icono">🛡️</div>
                    <h3 class="tarjeta-titulo">Jugador</h3>
                    <p class="tarjeta-texto">Gestiona tu personaje, lanza dados y únete a las partidas que te interesen.</p>
                </div>

                <div class="tarjeta">
                    <div class="tarjeta-icono">⚙️</div>
                    <h3 class="tarjeta-titulo">Administrador</h3>
                    <p class="tarjeta-texto">Supervisa el sistema, gestiona usuarios y modera el contenido de la plataforma.</p>
                </div>

            </div>

        </section>

    </main>


    {{-- PIE DE PÁGINA --}}
    <footer class="pie">

        <div class="pie-logo">⚔️ Forja de <span>Mundos</span></div>

        <p class="pie-texto">Proyecto académico · 2º DAW · Cristian Llada Álvarez</p>

        <nav class="pie-enlaces">
            <a href="{{ route('login') }}">Entrar</a>
            <a href="{{ route('register') }}">Registrarse</a>
        </nav>

    </footer>

</body>
</html>
