<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva contraseña — Forja de Mundos</title>
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

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="campo">
                    <label for="email" class="campo-etiqueta">Correo electrónico</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email', $request->email) }}"
                        class="campo-input"
                        placeholder="tu@correo.com"
                        required
                        autofocus
                        autocomplete="username"
                    >
                    @error('email')
                        <span class="campo-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="campo">
                    <label for="password" class="campo-etiqueta">Nueva contraseña</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        class="campo-input"
                        placeholder="••••••••"
                        required
                        autocomplete="new-password"
                    >
                    @error('password')
                        <span class="campo-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="campo">
                    <label for="password_confirmation" class="campo-etiqueta">Confirmar nueva contraseña</label>
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        class="campo-input"
                        placeholder="••••••••"
                        required
                        autocomplete="new-password"
                    >
                    @error('password_confirmation')
                        <span class="campo-error">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-morado btn-bloque">
                    Restablecer contraseña
                </button>
            </form>

        </div>
    </div>

</body>
</html>
