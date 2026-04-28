{{-- Formulario para eliminar la cuenta --}}

<p class="perfil-peligro-texto">
    Una vez eliminada tu cuenta, todos los datos serán borrados permanentemente.
    Asegúrate de guardar cualquier información antes de continuar.
</p>

{{-- Botón que muestra el formulario de confirmación --}}
<button
    type="button"
    class="btn btn-peligro"
    onclick="document.getElementById('confirmar-borrado').style.display='block'; this.style.display='none';"
>
    Eliminar mi cuenta
</button>

{{-- Formulario de confirmación — oculto por defecto --}}
<div id="confirmar-borrado" style="display:none;">

    <form method="POST" action="{{ route('profile.destroy') }}">
        @csrf
        @method('delete')

        {{-- Error de contraseña --}}
        @error('password', 'userDeletion')
            <div class="form-error">{{ $message }}</div>
        @enderror

        <div class="campo">
            <label for="delete_password" class="campo-etiqueta">
                Introduce tu contraseña para confirmar
            </label>
            <input
                id="delete_password"
                type="password"
                name="password"
                class="campo-input"
                placeholder="••••••••"
            >
        </div>

        <div class="perfil-borrado-acciones">
            <button type="submit" class="btn btn-peligro">
                Confirmar — eliminar cuenta
            </button>
            <button
                type="button"
                class="btn btn-contorno"
                onclick="document.getElementById('confirmar-borrado').style.display='none'; document.querySelector('.btn-peligro').style.display='inline-block';"
            >
                Cancelar
            </button>
        </div>

    </form>

</div>