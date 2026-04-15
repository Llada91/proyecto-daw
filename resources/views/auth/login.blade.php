<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar — Forja de Mundos</title>
    @vite(['resources/css/app.css'])
</head>
<body>

    <div class="auth-pagina">
        <div class="auth-tarjeta">

            {{-- Logo --}}
            <a href="/" class="auth-logo">
                ⚔️ Forja de <span>Mundos</span>
            </a>

            {{-- Mensajes de error generales --}}
            @if ($errors->any())
                <div class="form-error">
                    {{ $errors->first() }}
                </div>
            @endif

            {{-- Mensaje de sesión --}}
            @if (session('status'))
                <div class="form-exito">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Formulario de login --}}
            <form method="POST" action="{{ route('login') }}">
                @csrf

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
                        autofocus
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

                {{-- Recordarme --}}
                <div class="campo">
                    <label class="campo-recordar">
                        <input type="checkbox" name="remember" class="campo-checkbox">
                        <span class="campo-recordar-texto">Recordarme</span>
                    </label>
                </div>

                {{-- Botón enviar --}}
                <button type="submit" class="btn btn-morado btn-bloque">
                    Entrar
                </button>

            </form>

            {{-- Enlace a registro --}}
            <p class="auth-pie-texto">
                ¿No tienes cuenta?
                <a href="{{ route('register') }}">Regístrate gratis</a>
            </p>

            {{-- Enlace a recuperar contraseña --}}
            @if (Route::has('password.request'))
                <p class="auth-pie-texto">
                    <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                </p>
            @endif

        </div>
    </div>

</body>
</html>