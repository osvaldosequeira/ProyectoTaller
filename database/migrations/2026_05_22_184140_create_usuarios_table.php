```php id="v7n3kp"
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
     * Ejecuta la migración creando la tabla usuarios.
     */
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {

            // Clave primaria autoincremental.
            $table->id();

            // Nombre del usuario.
            $table->string('nombre');

            // Correo electrónico único.
            $table->string('email')->unique();

            // Contraseña del usuario.
            $table->string('password');

            // Clave foránea que relaciona el usuario con un rol.
            $table->foreignId('rol_id')
                  ->constrained('roles')
                  // Impide eliminar un rol si tiene usuarios asociados.
                  ->onDelete('restrict');

            // Token utilizado para la opción "recordarme".
            $table->rememberToken();

            // Campos created_at y updated_at.
            $table->timestamps();

            // Campo deleted_at para eliminaciones lógicas.
            $table->softDeletes();
        });
    }

    /**
     * Revierte la migración eliminando la tabla usuarios.
     */
    public function down(): void
    {
        // Elimina la tabla usuarios si existe.
        Schema::dropIfExists('usuarios');
    }
};
```
