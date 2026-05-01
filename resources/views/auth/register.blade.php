<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse — Forja de Mundos</title>
    @vite(['resources/css/app.css'])
</head>
<body>

    <div class="auth-pagina">
        <div class="auth-tarjeta">

            {{-- Logo --}}
            <a href="/" class="auth-logo">
                Forja de <span>Mundos</span>
            </a>

            {{-- Mensajes de error generales --}}
            @if ($errors->any())
                <div class="form-error">
                    {{ $errors->first() }}
                </div>
            @endif

            {{-- Formulario de registro --}}
            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Nombre --}}
                <div class="campo">
                    <label for="name" class="campo-etiqueta">Nombre de usuario</label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        class="campo-input"
                        placeholder="Tu nombre de aventurero"
                        required
                        autofocus
                    >
                    @error('name')
                        <span class="campo-error">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="campo">
                    <label for="email" class="campo-etiqueta">Correo electrónico</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="campo-input"
                        placeholder="tu@correo.com"
                        required
                    >
                    @error('email')
                        <span class="campo-error">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Contraseña --}}
                <div class="campo">
                    <label for="password" class="campo-etiqueta">Contraseña</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        class="campo-input"
                        placeholder="••••••••"
                        required
                    >
                    @error('password')
                        <span class="campo-error">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Confirmar contraseña --}}
                <div class="campo">
                    <label for="password_confirmation" class="campo-etiqueta">Confirmar contraseña</label>
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        class="campo-input"
                        placeholder="••••••••"
                        required
                    >
                    @error('password_confirmation')
                        <span class="campo-error">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Botón enviar --}}
                <button type="submit" class="btn btn-amarillo btn-bloque">
                    Crear cuenta
                </button>

            </form>

            {{-- Enlace al login --}}
            <p class="auth-pie-texto">
                ¿Ya tienes cuenta?
                <a href="{{ route('login') }}">Inicia sesión</a>
            </p>

        </div>
    </div>

</body>
</html>