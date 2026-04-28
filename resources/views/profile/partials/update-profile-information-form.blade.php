{{-- Formulario para actualizar nombre y email --}}
<form method="POST" action="{{ route('profile.update') }}">
    @csrf
    @method('patch')

    {{-- Mensaje de éxito --}}
    @if (session('status') === 'profile-updated')
        <div class="form-exito">
            Perfil actualizado correctamente.
        </div>
    @endif

    {{-- Nombre --}}
    <div class="campo">
        <label for="name" class="campo-etiqueta">Nombre de usuario</label>
        <input
            id="name"
            type="text"
            name="name"
            value="{{ old('name', $user->name) }}"
            class="campo-input"
            required
            autofocus
            autocomplete="name"
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
            value="{{ old('email', $user->email) }}"
            class="campo-input"
            required
            autocomplete="username"
        >
        @error('email')
            <span class="campo-error">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit" class="btn btn-morado">
        Guardar cambios
    </button>

</form>