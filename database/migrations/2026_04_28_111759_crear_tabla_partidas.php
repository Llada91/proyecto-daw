<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Crea la tabla partidas en la base de datos
    public function up(): void
    {
        Schema::create('partidas', function (Blueprint $tabla) {
            $tabla->id();

            // Nombre de la partida
            $tabla->string('nombre');

            // Descripción — nullable significa que puede estar vacío
            $tabla->text('descripcion')->nullable();

            // Añade una imagen
                $tabla->string('imagen')->nullable();

            // El usuario que creó la partida (el director)
            // constrained('users') crea la clave foránea hacia la tabla users
            $tabla->foreignId('creador_id')->constrained('users');

            // Crea automáticamente created_at y updated_at
            $tabla->timestamps();
        });
    }

    // Elimina la tabla si ejecutamos migrate:rollback
    public function down(): void
    {
        Schema::dropIfExists('partidas');
    }
};