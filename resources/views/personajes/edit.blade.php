@extends('layouts.panel')

@section('titulo', 'Editar personaje — Forja de Mundos')

@section('contenido')

    <div class="dashboard-cabecera">
        <div>
            <h1 class="dashboard-titulo">Editar personaje</h1>
            <p class="dashboard-subtitulo">{{ $personaje->datos['nombre'] ?? 'Sin nombre' }}</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="form-error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('personajes.update', $personaje) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- ---- INFORMACIÓN BÁSICA ---- --}}
        <div class="perfil-seccion">
            <h2 class="dashboard-seccion-titulo">Información básica</h2>
            <div class="perfil-tarjeta">

                <div class="campo">
                    <label for="nombre" class="campo-etiqueta">Nombre del personaje</label>
                    <input id="nombre" type="text" name="datos[nombre]"
                        value="{{ old('datos.nombre', $personaje->datos['nombre'] ?? '') }}"
                        class="campo-input" required autofocus>
                </div>

                <div class="ficha-grid-2">
                    <div class="campo">
                        <label for="raza" class="campo-etiqueta">Raza</label>
                        <input id="raza" type="text" name="datos[raza]"
                            value="{{ old('datos.raza', $personaje->datos['raza'] ?? '') }}"
                            class="campo-input">
                    </div>
                    <div class="campo">
                        <label for="clase" class="campo-etiqueta">Clase</label>
                        <input id="clase" type="text" name="datos[clase]"
                            value="{{ old('datos.clase', $personaje->datos['clase'] ?? '') }}"
                            class="campo-input">
                    </div>
                </div>

                <div class="ficha-grid-2">
                    <div class="campo">
                        <label for="nivel" class="campo-etiqueta">Nivel</label>
                        <input id="nivel" type="number" name="datos[nivel]"
                            value="{{ old('datos.nivel', $personaje->datos['nivel'] ?? 1) }}"
                            class="campo-input" min="1" max="20">
                    </div>
                    <div class="campo">
                        <label for="trasfondo" class="campo-etiqueta">Trasfondo</label>
                        <input id="trasfondo" type="text" name="datos[trasfondo]"
                            value="{{ old('datos.trasfondo', $personaje->datos['trasfondo'] ?? '') }}"
                            class="campo-input">
                    </div>
                </div>

                <div class="ficha-grid-2">
                    <div class="campo">
                        <label for="puntos_vida" class="campo-etiqueta">Puntos de vida</label>
                        <input id="puntos_vida" type="number" name="datos[puntos_vida]"
                            value="{{ old('datos.puntos_vida', $personaje->datos['puntos_vida'] ?? 10) }}"
                            class="campo-input" min="1">
                    </div>
                    <div class="campo">
                        <label for="clase_armadura" class="campo-etiqueta">Clase de armadura</label>
                        <input id="clase_armadura" type="number" name="datos[clase_armadura]"
                            value="{{ old('datos.clase_armadura', $personaje->datos['clase_armadura'] ?? 10) }}"
                            class="campo-input" min="1">
                    </div>
                </div>

                <div class="campo">
                    <label for="descripcion" class="campo-etiqueta">Historia del personaje</label>
                    <textarea id="descripcion" name="datos[descripcion]"
                        class="campo-input campo-textarea"
                    >{{ old('datos.descripcion', $personaje->datos['descripcion'] ?? '') }}</textarea>
                </div>

                <div class="campo">
                    <label for="imagen" class="campo-etiqueta">Imagen del personaje</label>
                    @if ($personaje->imagen)
                        <img src="{{ asset('storage/' . $personaje->imagen) }}" class="campo-imagen-preview">
                    @endif
                    <input id="imagen" type="file" name="imagen"
                        class="campo-input campo-file" accept="image/*">
                    @error('imagen')
                        <span class="campo-error">{{ $message }}</span>
                    @enderror
                </div>

            </div>
        </div>

        {{-- ---- CARACTERÍSTICAS ---- --}}
        <div class="perfil-seccion">
            <h2 class="dashboard-seccion-titulo">Características</h2>
            <div class="perfil-tarjeta">
                <div class="ficha-grid-3">
                    <div class="campo">
                        <label for="fuerza" class="campo-etiqueta">Fuerza</label>
                        <input id="fuerza" type="number" name="datos[fuerza]"
                            value="{{ old('datos.fuerza', $personaje->datos['fuerza'] ?? 10) }}"
                            class="campo-input campo-stat" min="1" max="20">
                    </div>
                    <div class="campo">
                        <label for="destreza" class="campo-etiqueta">Destreza</label>
                        <input id="destreza" type="number" name="datos[destreza]"
                            value="{{ old('datos.destreza', $personaje->datos['destreza'] ?? 10) }}"
                            class="campo-input campo-stat" min="1" max="20">
                    </div>
                    <div class="campo">
                        <label for="constitucion" class="campo-etiqueta">Constitución</label>
                        <input id="constitucion" type="number" name="datos[constitucion]"
                            value="{{ old('datos.constitucion', $personaje->datos['constitucion'] ?? 10) }}"
                            class="campo-input campo-stat" min="1" max="20">
                    </div>
                    <div class="campo">
                        <label for="inteligencia" class="campo-etiqueta">Inteligencia</label>
                        <input id="inteligencia" type="number" name="datos[inteligencia]"
                            value="{{ old('datos.inteligencia', $personaje->datos['inteligencia'] ?? 10) }}"
                            class="campo-input campo-stat" min="1" max="20">
                    </div>
                    <div class="campo">
                        <label for="sabiduria" class="campo-etiqueta">Sabiduría</label>
                        <input id="sabiduria" type="number" name="datos[sabiduria]"
                            value="{{ old('datos.sabiduria', $personaje->datos['sabiduria'] ?? 10) }}"
                            class="campo-input campo-stat" min="1" max="20">
                    </div>
                    <div class="campo">
                        <label for="carisma" class="campo-etiqueta">Carisma</label>
                        <input id="carisma" type="number" name="datos[carisma]"
                            value="{{ old('datos.carisma', $personaje->datos['carisma'] ?? 10) }}"
                            class="campo-input campo-stat" min="1" max="20">
                    </div>
                </div>
            </div>
        </div>

        <div class="tarjeta-acciones">
            <button type="submit" class="btn btn-morado">Guardar cambios</button>
            <a href="{{ route('personajes.index') }}" class="btn btn-contorno">Cancelar</a>
        </div>

    </form>

@endsection