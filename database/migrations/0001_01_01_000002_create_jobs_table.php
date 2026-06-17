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
        // Crea la tabla de trabajos pendientes (queues).
        Schema::create('jobs', function (Blueprint $table) {

            // Clave primaria autoincremental.
            $table->id();

            // Nombre de la cola donde se almacenará el trabajo.
            $table->string('queue')->index();

            // Información completa del trabajo en formato serializado.
            $table->longText('payload');

            // Cantidad de intentos realizados para ejecutar el trabajo.
            $table->unsignedTinyInteger('attempts');

            // Fecha en que el trabajo fue reservado para ejecución.
            $table->unsignedInteger('reserved_at')->nullable();

            // Fecha en que el trabajo estará disponible para ejecutarse.
            $table->unsignedInteger('available_at');

            // Fecha de creación del trabajo.
            $table->unsignedInteger('created_at');
        });

        // Crea la tabla para almacenar lotes de trabajos.
        Schema::create('job_batches', function (Blueprint $table) {

            // Identificador único del lote.
            $table->string('id')->primary();

            // Nombre del lote.
            $table->string('name');

            // Cantidad total de trabajos del lote.
            $table->integer('total_jobs');

            // Cantidad de trabajos pendientes.
            $table->integer('pending_jobs');

            // Cantidad de trabajos fallidos.
            $table->integer('failed_jobs');

            // IDs de los trabajos que fallaron.
            $table->longText('failed_job_ids');

            // Opciones adicionales del lote.
            $table->mediumText('options')->nullable();

            // Fecha de cancelación del lote.
            $table->integer('cancelled_at')->nullable();

            // Fecha de creación del lote.
            $table->integer('created_at');

            // Fecha en que finalizó el lote.
            $table->integer('finished_at')->nullable();
        });

        // Crea la tabla para registrar trabajos fallidos.
        Schema::create('failed_jobs', function (Blueprint $table) {

            // Clave primaria autoincremental.
            $table->id();

            // Identificador único del trabajo fallido.
            $table->string('uuid')->unique();

            // Conexión utilizada para ejecutar el trabajo.
            $table->text('connection');

            // Cola donde se encontraba el trabajo.
            $table->text('queue');

            // Datos completos del trabajo.
            $table->longText('payload');

            // Información detallada de la excepción generada.
            $table->longText('exception');

            // Fecha y hora en que ocurrió el error.
            $table->timestamp('failed_at')->useCurrent();
        });
    }

    /**
     * Revierte la migración eliminando las tablas creadas.
     */
    public function down(): void
    {
        // Elimina la tabla jobs si existe.
        Schema::dropIfExists('jobs');

        // Elimina la tabla job_batches si existe.
        Schema::dropIfExists('job_batches');

        // Elimina la tabla failed_jobs si existe.
        Schema::dropIfExists('failed_jobs');
    }
};