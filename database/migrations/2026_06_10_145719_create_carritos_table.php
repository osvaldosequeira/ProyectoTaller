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
     * Ejecuta la migración creando la tabla carritos.
     */
    public function up(): void
    {
        Schema::create('carritos', function (Blueprint $table) {

            // Clave primaria autoincremental.
            $table->id();

            // Clave foránea que relaciona el carrito con un usuario.
            // Si el usuario se elimina, también se elimina su carrito.
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            // Campos created_at y updated_at.
            $table->timestamps();
        });
    }

    /**
     * Revierte la migración eliminando la tabla carritos.
     */
    public function down(): void
    {
        // Elimina la tabla carritos si existe.
        Schema::dropIfExists('carritos');
    }
};