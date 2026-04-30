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
    Route::resource('partidas', PartidaController::class);

    // Invitar y quitar personajes de una partida
    Route::get('partidas/{partida}/invitar',    [PartidaController::class, 'invitar'])->name('partidas.invitar');
    Route::post('partidas/{partida}/invitar',   [PartidaController::class, 'agregarPersonaje'])->name('partidas.agregarPersonaje');
    Route::delete('partidas/{partida}/invitar', [PartidaController::class, 'quitarPersonaje'])->name('partidas.quitarPersonaje');

    // Rutas de la sala de juego
    Route::get('partidas/{partida}/sala',           [App\Http\Controllers\SalaController::class, 'show'])->name('sala.show');
    Route::post('partidas/{partida}/sala/mensaje',  [App\Http\Controllers\SalaController::class, 'enviarMensaje'])->name('sala.mensaje');
    Route::post('partidas/{partida}/sala/dado',     [App\Http\Controllers\SalaController::class, 'tirarDado'])->name('sala.dado');
    Route::post('partidas/{partida}/sala/personaje',[App\Http\Controllers\SalaController::class, 'elegirPersonaje'])->name('sala.personaje');

    // Rutas de personajes
    Route::resource('personajes', PersonajeController::class);

    // Rutas de administración — solo para usuarios con rol admin
    Route::middleware('es.admin')->group(function () {
        Route::get('/admin',                              [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
        Route::delete('/admin/usuarios/{user}',           [App\Http\Controllers\AdminController::class, 'eliminarUsuario'])->name('admin.eliminarUsuario');
        Route::delete('/admin/partidas/{partida}',        [App\Http\Controllers\AdminController::class, 'eliminarPartida'])->name('admin.eliminarPartida');
        Route::delete('/admin/personajes/{personaje}',    [App\Http\Controllers\AdminController::class, 'eliminarPersonaje'])->name('admin.eliminarPersonaje');
    });

});

require __DIR__ . '/auth.php';