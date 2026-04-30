<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña — Forja de Mundos</title>
    @vite(['resources/css/app.css'])
</head>
<body>

    <div class="auth-pagina">
        <div class="auth-tarjeta">

            <a href="/" class="auth-logo">
                ⚔️ Forja de <span>Mundos</span>
            </a>

            @if (session('status'))
                <div class="form-exito">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="form-error">
                    {{ $errors->first() }}
                </div>
            @endif

            <p style="font-size:0.9rem; color:var(--gris); font-style:italic; margin-bottom:1.5rem; line-height:1.6;">
                Introduce tu correo y te enviaremos un enlace para restablecer tu contraseña.
            </p>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

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

                <button type="submit" class="btn btn-morado btn-bloque">
                    Enviar enlace de recuperación
                </button>
            </form>

            <p class="auth-pie-texto">
                <a href="{{ route('login') }}">← Volver al inicio de sesión</a>
            </p>

        </div>
    </div>

</body>
</html>
