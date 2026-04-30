@extends('layouts.panel')

@section('titulo', 'Editar partida — Forja de Mundos')

@section('contenido')

    <div class="dashboard-cabecera">
        <div>
            <h1 class="dashboard-titulo">Editar partida</h1>
            <p class="dashboard-subtitulo">{{ $partida->nombre }}</p>
        </div>
    </div>

    <div class="perfil-seccion">
        <div class="perfil-tarjeta">

            @if ($errors->any())
                <div class="form-error">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('partidas.update', $partida) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="campo">
                    <label for="nombre" class="campo-etiqueta">Nombre de la partida</label>
                    <input id="nombre" type="text" name="nombre"
                        value="{{ old('nombre', $partida->nombre) }}"
                        class="campo-input" required autofocus>
                    @error('nombre')
                        <span class="campo-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="campo">
                    <label for="descripcion" class="campo-etiqueta">Descripción</label>
                    <textarea id="descripcion" name="descripcion"
                        class="campo-input campo-textarea"
                    >{{ old('descripcion', $partida->descripcion) }}</textarea>
                    @error('descripcion')
                        <span class="campo-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="campo">
                    <label for="imagen" class="campo-etiqueta">Imagen de portada</label>
                    @if ($partida->imagen)
                        <img src="{{ asset('storage/' . $partida->imagen) }}" class="campo-imagen-preview">
                    @endif
                    <input id="imagen" type="file" name="imagen"
                        class="campo-input campo-file" accept="image/*">
                    @error('imagen')
                        <span class="campo-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="tarjeta-acciones">
                    <button type="submit" class="btn btn-morado">Guardar cambios</button>
                    <a href="{{ route('partidas.index') }}" class="btn btn-contorno">Cancelar</a>
                </div>

            </form>

        </div>
    </div>

@endsection