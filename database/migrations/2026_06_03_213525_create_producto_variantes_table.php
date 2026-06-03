<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('producto_variantes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
            $table->string('tamanio'); // Pequeña, Mediana, Grande
            $table->string('contenido'); // Contiene 1-2 ítems, 3-5 ítems, etc.
            $table->decimal('precio_adicional', 10, 2)->default(0.00); // Por si la grande cuesta más
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('producto_variantes');
    }
};