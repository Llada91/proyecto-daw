@extends('layouts.panel')

@section('titulo', 'Nueva partida — Forja de Mundos')

@section('contenido')

    <div class="dashboard-cabecera">
        <div>
            <h1 class="dashboard-titulo">Nueva partida</h1>
            <p class="dashboard-subtitulo">Crea una nueva partida como director de juego</p>
        </div>
    </div>

    <div class="perfil-seccion">
        <div class="perfil-tarjeta">

            @if ($errors->any())
                <div class="form-error">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('partidas.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="campo">
                    <label for="nombre" class="campo-etiqueta">Nombre de la partida</label>
                    <input id="nombre" type="text" name="nombre"
                        value="{{ old('nombre') }}" class="campo-input"
                        placeholder="La Mina Perdida..." required autofocus>
                    @error('nombre')
                        <span class="campo-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="campo">
                    <label for="descripcion" class="campo-etiqueta">Descripción</label>
                    <textarea id="descripcion" name="descripcion"
                        class="campo-input campo-textarea"
                        placeholder="Describe de qué trata la partida..."
                    >{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <span class="campo-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="campo">
                    <label for="imagen" class="campo-etiqueta">Imagen de portada</label>
                    <input id="imagen" type="file" name="imagen"
                        class="campo-input campo-file" accept="image/*">
                    @error('imagen')
                        <span class="campo-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="tarjeta-acciones">
                    <button type="submit" class="btn btn-morado">Crear partida</button>
                    <a href="{{ route('partidas.index') }}" class="btn btn-contorno">Cancelar</a>
                </div>

            </form>

        </div>
    </div>

@endsection