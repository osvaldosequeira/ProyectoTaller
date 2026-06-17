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
     * Ejecuta la migración creando la tabla detalle_ventas.
     */
    public function up(): void
    {
        Schema::create('detalle_ventas', function (Blueprint $table) {

            // Clave primaria autoincremental.
            $table->id();

            // Clave foránea que relaciona el detalle con una venta.
            // Si la venta se elimina, también se eliminan sus detalles.
            $table->foreignId('venta_cabecera_id')
                  ->constrained('venta_cabeceras')
                  ->onDelete('cascade');

            // Clave foránea que relaciona el detalle con un producto.
            // Si el producto se elimina, también se eliminan los detalles asociados.
            $table->foreignId('producto_id')
                  ->constrained('productos')
                  ->onDelete('cascade');

            // Cantidad de unidades vendidas del producto.
            $table->integer('cantidad');

            // Precio unitario del producto al momento de la venta.
            $table->decimal('precio_unitario', 10, 2);

            // Tamaño seleccionado del producto.
            $table->string('tamanio');

            // Talle seleccionado del producto.
            $table->string('talle');

            // Campos created_at y updated_at.
            $table->timestamps();
        });
    }

    /**
     * Revierte la migración eliminando la tabla detalle_ventas.
     */
    public function down(): void
    {
        // Elimina la tabla detalle_ventas si existe.
        Schema::dropIfExists('detalle_ventas');
    }
};