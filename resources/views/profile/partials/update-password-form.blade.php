{{-- Formulario para cambiar la contraseña --}}
<form method="POST" action="{{ route('password.update') }}">
    @csrf
    @method('put')

    {{-- Mensaje de éxito --}}
    @if (session('status') === 'password-updated')
        <div class="form-exito">
            Contraseña actualizada correctamente.
        </div>
    @endif

    {{-- Contraseña actual --}}
    <div class="campo">
        <label for="current_password" class="campo-etiqueta">Contraseña actual</label>
        <input
            id="current_password"
            type="password"
            name="current_password"
            class="campo-input"
            placeholder="••••••••"
            autocomplete="current-password"
        >
        @error('current_password', 'updatePassword')
            <span class="campo-error">{{ $message }}</span>
        @enderror
    </div>

    {{-- Nueva contraseña --}}
    <div class="campo">
        <label for="password" class="campo-etiqueta">Nueva contraseña</label>
        <input
            id="password"
            type="password"
            name="password"
            class="campo-input"
            placeholder="••••••••"
            autocomplete="new-password"
        >
        @error('password', 'updatePassword')
            <span class="campo-error">{{ $message }}</span>
        @enderror
    </div>

    {{-- Confirmar nueva contraseña --}}
    <div class="campo">
        <label for="password_confirmation" class="campo-etiqueta">Confirmar nueva contraseña</label>
        <input
            id="password_confirmation"
            type="password"
            name="password_confirmation"
            class="campo-input"
            placeholder="••••••••"
            autocomplete="new-password"
        >
        @error('password_confirmation', 'updatePassword')
            <span class="campo-error">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit" class="btn btn-morado">
        Cambiar contraseña
    </button>

</form>