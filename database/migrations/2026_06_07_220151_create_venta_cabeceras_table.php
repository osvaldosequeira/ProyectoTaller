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
     * Ejecuta la migración creando la tabla venta_cabeceras.
     */
    public function up(): void
    {
        Schema::create('venta_cabeceras', function (Blueprint $table) {

            // Clave primaria autoincremental.
            $table->id();

            // Clave foránea que relaciona la venta con un usuario.
            // Si el usuario se elimina, también se eliminan sus ventas.
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            // Fecha y hora en que se realizó la venta.
            $table->dateTime('fecha');

            // Importe total de la venta.
            $table->decimal('total', 10, 2);

            // Campos created_at y updated_at.
            $table->timestamps();
        });
    }

    /**
     * Revierte la migración eliminando la tabla venta_cabeceras.
     */
    public function down(): void
    {
        // Elimina la tabla venta_cabeceras si existe.
        Schema::dropIfExists('venta_cabeceras');
    }
};