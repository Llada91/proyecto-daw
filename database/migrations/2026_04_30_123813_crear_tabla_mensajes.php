<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Crea la tabla mensajes en la base de datos
    public function up(): void
    {
        Schema::create('mensajes', function (Blueprint $tabla) {
            $tabla->id();

            // A qué partida pertenece este mensaje
            $tabla->foreignId('partida_id')->constrained('partidas');

            // Qué personaje lo escribió o tiró el dado
            $tabla->foreignId('personaje_id')->constrained('personajes');

            // Tipo: 'mensaje' o 'tirada'
            $tabla->enum('tipo', ['mensaje', 'tirada']);

            // El texto del mensaje o el resultado de la tirada
            $tabla->text('contenido');

            // Fecha automática
            $tabla->timestamps();
        });
    }

    // Elimina la tabla si ejecutamos migrate:rollback
    public function down(): void
    {
        Schema::dropIfExists('mensajes');
    }
};