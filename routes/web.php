<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PartidaController;
use App\Http\Controllers\PersonajeController;
use Illuminate\Support\Facades\Route;

// Página de inicio — no requiere autenticación
Route::get('/', function () {
    return view('welcome');
});

// Dashboard — requiere autenticación
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Rutas que requieren autenticación
Route::middleware('auth')->group(function () {

    // Rutas del perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas de partidas
    // Genera: index, create, store, show, edit, update, destroy
    Route::resource('partidas', PartidaController::class);

    // Rutas de partidas
    Route::resource('partidas', PartidaController::class);

    // Invitar personajes a una partida
    Route::get('partidas/{partida}/invitar',  [PartidaController::class, 'invitar'])->name('partidas.invitar');
    Route::post('partidas/{partida}/invitar', [PartidaController::class, 'agregarPersonaje'])->name('partidas.agregarPersonaje');

    // Rutas de personajes
    // Genera: index, create, store, show, edit, update, destroy
    Route::resource('personajes', PersonajeController::class);

    Route::delete('partidas/{partida}/invitar', [PartidaController::class, 'quitarPersonaje'])
        ->name('partidas.quitarPersonaje');
});

require __DIR__ . '/auth.php';
