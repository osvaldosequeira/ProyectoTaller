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
     * Ejecuta la migración creando la tabla productos.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {

            // Clave primaria autoincremental.
            $table->id();

            // Nombre del producto.
            $table->string('nombre');

            // Descripción del producto (opcional).
            $table->text('descripcion')->nullable();

            // Precio del producto con 10 dígitos en total y 2 decimales.
            $table->decimal('precio', 10, 2);

            // Cantidad disponible en stock.
            $table->integer('stock')->default(0);

            // Ruta o nombre de la imagen del producto.
            // Puede quedar vacío si aún no se cargó una imagen.
            $table->string('imagen')->nullable();

            // Campo deleted_at para eliminaciones lógicas.
            // Requerido para utilizar SoftDeletes en el modelo.
            $table->softDeletes();

            // Campos created_at y updated_at.
            $table->timestamps();
        });
    }

    /**
     * Revierte la migración eliminando la tabla productos.
     */
    public function down(): void
    {
        // Elimina la tabla productos si existe.
        Schema::dropIfExists('productos');
    }
};