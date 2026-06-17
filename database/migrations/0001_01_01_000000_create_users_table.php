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
        // Crea la tabla de usuarios.
        Schema::create('users', function (Blueprint $table) {

            // Clave primaria autoincremental.
            $table->id();

            // Nombre del usuario.
            $table->string('name');

            // Correo electrónico único.
            $table->string('email')->unique();

            // Fecha de verificación del correo.
            $table->timestamp('email_verified_at')->nullable();

            // Contraseña del usuario.
            $table->string('password');

            // Token utilizado para la opción "recordarme".
            $table->rememberToken();

            // Campos created_at y updated_at.
            $table->timestamps();
        });

        // Crea la tabla utilizada para restablecimiento de contraseñas.
        Schema::create('password_reset_tokens', function (Blueprint $table) {

            // El correo será la clave primaria.
            $table->string('email')->primary();

            // Token generado para recuperar la contraseña.
            $table->string('token');

            // Fecha de creación del token.
            $table->timestamp('created_at')->nullable();
        });

        // Crea la tabla utilizada por Laravel para gestionar sesiones.
        Schema::create('sessions', function (Blueprint $table) {

            // Identificador único de la sesión.
            $table->string('id')->primary();

            // ID del usuario asociado a la sesión.
            $table->foreignId('user_id')->nullable()->index();

            // Dirección IP desde donde inició sesión.
            $table->string('ip_address', 45)->nullable();

            // Información del navegador utilizado.
            $table->text('user_agent')->nullable();

            // Datos almacenados de la sesión.
            $table->longText('payload');

            // Última actividad registrada en la sesión.
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Revierte la migración eliminando las tablas creadas.
     */
    public function down(): void
    {
        // Elimina la tabla users si existe.
        Schema::dropIfExists('users');

        // Elimina la tabla password_reset_tokens si existe.
        Schema::dropIfExists('password_reset_tokens');

        // Elimina la tabla sessions si existe.
        Schema::dropIfExists('sessions');
    }
};