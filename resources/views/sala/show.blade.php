<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $partida->nombre }} — Sala de juego</title>
    @vite(['resources/css/app.css'])
</head>
<body>

    <div class="sala">

        {{-- =============================================
             CABECERA DE LA SALA
        ============================================= --}}
        <header class="sala-cabecera">
            <div class="sala-cabecera-izquierda">
                <a href="{{ route('partidas.show', $partida) }}" class="sala-volver">
                    ← Volver
                </a>
                <h1 class="sala-titulo">{{ $partida->nombre }}</h1>
            </div>
            <div class="sala-cabecera-derecha">
                @if ($miPersonaje)
                    <span class="sala-personaje-activo">
                        Jugando como:
                        <strong>{{ $miPersonaje->datos['nombre'] ?? 'Sin nombre' }}</strong>
                    </span>
                @else
                    <span class="sala-sin-personaje">
                        Solo puedes observar — no tienes personaje en esta partida
                    </span>
                @endif
            </div>
        </header>


        {{-- =============================================
             CUERPO DE LA SALA
        ============================================= --}}
        <div class="sala-cuerpo">

            {{-- ---- REGISTRO CENTRAL ---- --}}
            <div class="sala-registro">

                {{-- Lista de mensajes y tiradas --}}
                <div class="sala-mensajes" id="sala-mensajes">

                    @if ($mensajes->isEmpty())
                        <p class="sala-vacio">
                            La partida acaba de empezar. ¡Escribe algo para comenzar la aventura!
                        </p>
                    @else
                        @foreach ($mensajes as $mensaje)
                            <div class="sala-mensaje {{ $mensaje->tipo === 'tirada' ? 'sala-mensaje-tirada' : '' }}">

                                {{-- Avatar del personaje --}}
                                @if ($mensaje->personaje->imagen)
                                    <img src="{{ asset('storage/' . $mensaje->personaje->imagen) }}" class="sala-avatar">
                                @else
                                    <img src="{{ asset('img/pj-default.png') }}" class="sala-avatar">
                                @endif

                                <div class="sala-mensaje-contenido">
                                    <div class="sala-mensaje-cabecera">
                                        <span class="sala-mensaje-nombre">
                                            {{ $mensaje->personaje->datos['nombre'] ?? 'Sin nombre' }}
                                        </span>
                                        <span class="sala-mensaje-hora">
                                            {{ $mensaje->created_at->format('H:i') }}
                                        </span>
                                    </div>
                                    <p class="sala-mensaje-texto">
                                        {{ $mensaje->contenido }}
                                    </p>
                                </div>

                            </div>
                        @endforeach
                    @endif

                </div>

                {{-- ---- ZONA DE ACCIÓN ---- --}}
                @if ($miPersonaje)

                    {{-- Botones de dados --}}
                    <div class="sala-dados">
                        @foreach ([4, 6, 8, 10, 12, 20, 100] as $dado)
                            <form action="{{ route('sala.dado', $partida) }}" method="POST">
                                @csrf
                                <input type="hidden" name="dado" value="{{ $dado }}">
                                <button type="submit" class="btn-dado">
                                    d{{ $dado }}
                                </button>
                            </form>
                        @endforeach
                    </div>

                    {{-- Campo de escritura --}}
                    <form action="{{ route('sala.mensaje', $partida) }}" method="POST" class="sala-form">
                        @csrf
                        <input
                            type="text"
                            name="contenido"
                            class="sala-input"
                            placeholder="Escribe tu acción o mensaje..."
                            autocomplete="off"
                            required
                        >
                        <button type="submit" class="btn btn-morado">
                            Enviar
                        </button>
                    </form>

                @else
                    <div class="sala-observador">
                        <p>Eres observador. Solo el director puede añadirte a la partida con un personaje.</p>
                    </div>
                @endif

            </div>


            {{-- ---- PANEL DERECHO: PERSONAJES ---- --}}
            <aside class="sala-panel">

                <h2 class="sala-panel-titulo">Personajes</h2>

                <div class="sala-panel-lista">
                    @foreach ($personajes as $personaje)

                        @php
                            // Comprobamos si este personaje pertenece al usuario actual
                            $esMio = $personaje->usuario_id === auth()->id();
                            // Comprobamos si es el personaje activo
                            $esActivo = $miPersonaje && $personaje->id === $miPersonaje->id;
                        @endphp

                        @if ($esMio)
                            {{-- Si es mío lo envuelvo en un formulario para poder seleccionarlo --}}
                            <form action="{{ route('sala.personaje', $partida) }}" method="POST">
                                @csrf
                                <input type="hidden" name="personaje_id" value="{{ $personaje->id }}">
                                <button type="submit" class="sala-panel-personaje {{ $esActivo ? 'sala-panel-personaje-activo' : '' }} sala-panel-personaje-mio">
                                    @if ($personaje->imagen)
                                        <img src="{{ asset('storage/' . $personaje->imagen) }}" class="sala-panel-avatar">
                                    @else
                                        <img src="{{ asset('img/pj-default.png') }}" class="sala-panel-avatar">
                                    @endif
                                    <div class="sala-panel-info">
                                        <span class="sala-panel-nombre">
                                            {{ $personaje->datos['nombre'] ?? 'Sin nombre' }}
                                        </span>
                                        <span class="sala-panel-clase">
                                            {{ $personaje->datos['clase'] ?? '' }}
                                            · Nv {{ $personaje->datos['nivel'] ?? 1 }}
                                        </span>
                                        <span class="sala-panel-jugador">
                                            {{ $personaje->usuario->name }}
                                            @if ($esActivo)
                                                · <span class="sala-panel-activo-texto">activo</span>
                                            @endif
                                        </span>
                                    </div>
                                </button>
                            </form>
                        @else
                            {{-- Si no es mío solo lo muestro sin formulario --}}
                            <div class="sala-panel-personaje">
                                @if ($personaje->imagen)
                                    <img src="{{ asset('storage/' . $personaje->imagen) }}" class="sala-panel-avatar">
                                @else
                                    <img src="{{ asset('img/pj-default.png') }}" class="sala-panel-avatar">
                                @endif
                                <div class="sala-panel-info">
                                    <span class="sala-panel-nombre">
                                        {{ $personaje->datos['nombre'] ?? 'Sin nombre' }}
                                    </span>
                                    <span class="sala-panel-clase">
                                        {{ $personaje->datos['clase'] ?? '' }}
                                        · Nv {{ $personaje->datos['nivel'] ?? 1 }}
                                    </span>
                                    <span class="sala-panel-jugador">
                                        {{ $personaje->usuario->name }}
                                    </span>
                                </div>
                            </div>
                        @endif

                    @endforeach
                </div>

            </aside>

        </div>{{-- fin .sala-cuerpo --}}

    </div>{{-- fin .sala --}}


    {{-- Scroll automático al último mensaje --}}
    <script>
        const contenedor = document.getElementById('sala-mensajes');
        if (contenedor) {
            contenedor.scrollTop = contenedor.scrollHeight;
        }
    </script>

</body>
</html>