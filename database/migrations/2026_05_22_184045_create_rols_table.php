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
     * Ejecuta la migración creando la tabla roles.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {

            // Clave primaria autoincremental.
            $table->id();

            // Nombre del rol. Debe ser único.
            $table->string('nombre')->unique();

            // Descripción opcional del rol.
            $table->string('descripcion')->nullable();

            // Campos created_at y updated_at.
            $table->timestamps();

            // Campo deleted_at para eliminaciones lógicas.
            $table->softDeletes();
        });
    }

    /**
     * Revierte la migración eliminando la tabla roles.
     */
    public function down(): void
    {
        // Elimina la tabla roles si existe.
        Schema::dropIfExists('roles');
    }
};