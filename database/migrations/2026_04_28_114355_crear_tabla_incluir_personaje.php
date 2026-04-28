<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Crea la tabla intermedia entre personajes y partidas
    public function up(): void
    {
        Schema::create('incluir_personaje', function (Blueprint $tabla) {

            // Qué partida
            $tabla->foreignId('partida_id')->constrained('partidas');

            // Qué personaje
            $tabla->foreignId('personaje_id')->constrained('personajes');

            // La clave primaria es la combinación de los dos campos
            // Así no puede haber el mismo personaje dos veces en la misma partida
            $tabla->primary(['partida_id', 'personaje_id']);

            $tabla->timestamps();
        });
    }

    // Elimina la tabla si ejecutamos migrate:rollback
    public function down(): void
    {
        Schema::dropIfExists('incluir_personaje');
    }
};