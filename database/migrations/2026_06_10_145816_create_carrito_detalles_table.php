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
     * Ejecuta la migración creando la tabla carrito_detalles.
     */
    public function up(): void
    {
        Schema::create('carrito_detalles', function (Blueprint $table) {

            // Clave primaria autoincremental.
            $table->id();

            // Clave foránea que relaciona el detalle con un carrito.
            // Si el carrito se elimina, también se eliminan sus detalles.
            $table->foreignId('carrito_id')
                ->constrained('carritos')
                ->onDelete('cascade');

            // Clave foránea que relaciona el detalle con un producto.
            // Si el producto se elimina, también se eliminan los detalles asociados.
            $table->foreignId('producto_id')
                ->constrained('productos')
                ->onDelete('cascade');

            // Cantidad del producto agregada al carrito.
            $table->integer('cantidad');

            // Precio del producto al momento de agregarlo al carrito.
            $table->decimal('precio', 10, 2);

            // Tamaño seleccionado del producto.
            $table->string('tamanio');

            // Talle seleccionado del producto.
            $table->string('talle');

            // Campos created_at y updated_at.
            $table->timestamps();
        });
    }

    /**
     * Revierte la migración eliminando la tabla carrito_detalles.
     */
    public function down(): void
    {
        // Elimina la tabla carrito_detalles si existe.
        Schema::dropIfExists('carrito_detalles');
    }
};