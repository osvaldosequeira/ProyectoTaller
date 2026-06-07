<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mensajes', function (Blueprint $table) {
            $table->id();
            // Campo de relación: nullable permite que entren consultas de usuarios no logueados (Anónimos)
            $table->unsignedBigInteger('user_id')->nullable(); 
            $table->string('nombre');
            $table->string('email');
            $table->text('mensaje');
            $table->timestamps();

            // Clave foránea conectada a la tabla de usuarios
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mensajes');
    }
};