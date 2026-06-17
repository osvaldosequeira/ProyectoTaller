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
     * Ejecuta la migración creando la tabla producto_variantes.
     */
    public function up(): void
    {
        Schema::create('producto_variantes', function (Blueprint $table) {

            // Clave primaria autoincremental.
            $table->id();

            // Clave foránea que relaciona la variante con un producto.
            // Si se elimina el producto, también se eliminan sus variantes.
            $table->foreignId('producto_id')
                  ->constrained('productos')
                  ->onDelete('cascade');

            // Tamaño de la variante.
            // Ejemplos: Pequeña, Mediana, Grande.
            $table->string('tamanio');

            // Descripción del contenido de la variante.
            // Ejemplos: Contiene 1-2 ítems, 3-5 ítems, etc.
            $table->string('contenido');

            // Precio adicional de la variante.
            // Puede utilizarse si una variante cuesta más que otra.
            $table->decimal('precio_adicional', 10, 2)->default(0.00);

            // Campos created_at y updated_at.
            $table->timestamps();
        });
    }

    /**
     * Revierte la migración eliminando la tabla producto_variantes.
     */
    public function down(): void
    {
        // Elimina la tabla producto_variantes si existe.
        Schema::dropIfExists('producto_variantes');
    }
};