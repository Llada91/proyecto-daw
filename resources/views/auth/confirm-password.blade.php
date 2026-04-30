<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar contraseña — Forja de Mundos</title>
    @vite(['resources/css/app.css'])
</head>
<body>

    <div class="auth-pagina">
        <div class="auth-tarjeta">

            <a href="/" class="auth-logo">
                ⚔️ Forja de <span>Mundos</span>
            </a>

            @if ($errors->any())
                <div class="form-error">
                    {{ $errors->first() }}
                </div>
            @endif

            <p style="font-size:0.9rem; color:var(--gris); font-style:italic; margin-bottom:1.5rem; line-height:1.6;">
                Zona segura. Confirma tu contraseña para continuar.
            </p>

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <div class="campo">
                    <label for="password" class="campo-etiqueta">Contraseña</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        class="campo-input"
                        placeholder="••••••••"
                        required
                        autocomplete="current-password"
                    >
                    @error('password')
                        <span class="campo-error">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-morado btn-bloque">
                    Confirmar
                </button>
            </form>

        </div>
    </div>

</body>
</html>
