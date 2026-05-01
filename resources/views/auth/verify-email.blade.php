<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifica tu correo — Forja de Mundos</title>
    @vite(['resources/css/app.css'])
</head>
<body>

    <div class="auth-pagina">
        <div class="auth-tarjeta">

            <a href="/" class="auth-logo">
                Forja de <span>Mundos</span>
            </a>

            @if (session('status') == 'verification-link-sent')
                <div class="form-exito">
                    Se ha enviado un nuevo enlace de verificación a tu correo.
                </div>
            @endif

            <p style="font-size:0.9rem; color:var(--gris); font-style:italic; margin-bottom:1.5rem; line-height:1.6;">
                Gracias por registrarte. Antes de continuar, verifica tu dirección de correo haciendo clic en el enlace que te hemos enviado.
            </p>

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn btn-morado btn-bloque">
                    Reenviar correo de verificación
                </button>
            </form>

            <p class="auth-pie-texto">
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" style="background:none; border:none; cursor:pointer; color:var(--gris); font-size:0.88rem; font-style:italic; font-family:inherit;">
                        Cerrar sesión
                    </button>
                </form>
            </p>

        </div>
    </div>

</body>
</html>
