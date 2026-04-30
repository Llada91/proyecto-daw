<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Crea la tabla personajes en la base de datos
    public function up(): void
    {
        Schema::create('personajes', function (Blueprint $tabla) {
            $tabla->id();

            // A qué usuario pertenece este personaje
            $tabla->foreignId('usuario_id')->constrained('users');

            // Toda la ficha del personaje en formato JSON
            // nombre, raza, clase, nivel, fuerza, etc.
            $tabla->json('datos')->nullable();

            // Añade una imagen
            $tabla->string('imagen')->nullable();

            // Crea automáticamente created_at y updated_at
            $tabla->timestamps();
        });
    }

    // Elimina la tabla si ejecutamos migrate:rollback
    public function down(): void
    {
        Schema::dropIfExists('personajes');
    }
};
