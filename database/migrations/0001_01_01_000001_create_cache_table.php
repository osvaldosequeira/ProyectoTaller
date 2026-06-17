<?php

// Importa la clase base para crear migraciones.
use Illuminate\Database\Migrations\Migration;

// Permite definir la estructura de las tablas.
use Illuminate\Database\Schema\Blueprint;

// Proporciona métodos para crear, modificar y eliminar tablas.
use Illuminate\Support\Facades\Schema;

// Define una migración anónima.
return new class extends Migration
{
    /**
     * Ejecuta la migración creando las tablas necesarias.
     */
    public function up(): void
    {
        // Crea la tabla utilizada por Laravel para almacenar caché.
        Schema::create('cache', function (Blueprint $table) {

            // Clave única que identifica cada elemento de caché.
            $table->string('key')->primary();

            // Valor almacenado en la caché.
            $table->mediumText('value');

            // Tiempo de expiración del registro.
            $table->bigInteger('expiration')->index();
        });

        // Crea la tabla utilizada para gestionar bloqueos de caché.
        Schema::create('cache_locks', function (Blueprint $table) {

            // Clave única del bloqueo.
            $table->string('key')->primary();

            // Propietario del bloqueo.
            $table->string('owner');

            // Tiempo de expiración del bloqueo.
            $table->bigInteger('expiration')->index();
        });
    }

    /**
     * Revierte la migración eliminando las tablas creadas.
     */
    public function down(): void
    {
        // Elimina la tabla cache si existe.
        Schema::dropIfExists('cache');

        // Elimina la tabla cache_locks si existe.
        Schema::dropIfExists('cache_locks');
    }
};