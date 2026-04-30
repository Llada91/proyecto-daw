@extends('layouts.panel')

@section('titulo', 'Mi perfil — Forja de Mundos')

@section('contenido')

    <div class="dashboard-cabecera">
        <div>
            <h1 class="dashboard-titulo">Mi perfil</h1>
            <p class="dashboard-subtitulo">Gestiona tu información personal</p>
        </div>
    </div>

    {{-- Sección 1: Información del perfil --}}
    <div class="perfil-seccion">
        <h2 class="dashboard-seccion-titulo">Información de la cuenta</h2>
        <div class="perfil-tarjeta">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    {{-- Sección 2: Cambiar contraseña --}}
    <div class="perfil-seccion">
        <h2 class="dashboard-seccion-titulo">Cambiar contraseña</h2>
        <div class="perfil-tarjeta">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    {{-- Sección 3: Eliminar cuenta --}}
    <div class="perfil-seccion">
        <h2 class="dashboard-seccion-titulo">Zona de peligro</h2>
        <div class="perfil-tarjeta perfil-tarjeta-peligro">
            @include('profile.partials.delete-user-form')
        </div>
    </div>

@endsection