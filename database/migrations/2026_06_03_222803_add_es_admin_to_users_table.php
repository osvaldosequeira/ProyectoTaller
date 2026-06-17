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
     * Ejecuta la migración agregando una nueva columna a la tabla users.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            // Indica si el usuario es administrador o cliente.
            // 0 = Cliente Normal
            // 1 = Administrador
            // Por defecto todos los usuarios se crean como clientes.
            $table->boolean('es_admin')->default(0)->after('email');
        });
    }

    /**
     * Revierte la migración eliminando la columna agregada.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            // Elimina la columna es_admin.
            $table->dropColumn('es_admin');
        });
    }
};