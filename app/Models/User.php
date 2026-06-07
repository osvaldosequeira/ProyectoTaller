<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany; // Necesario para la relación de mensajes

// ✅ CORREGIDO: Se agregó 'es_admin' al atributo Fillable de Laravel 11 para permitir cambios de rol
#[Fillable(['name', 'email', 'password', 'es_admin'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Tabla explícita en MariaDB
    protected $table = 'users'; 

    /**
     * Conversión de tipos nativos (Casting).
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed', // Las claves se verifican encriptadas automáticamente
            'es_admin' => 'integer', // Asegura que se trate como un entero (0 o 1) al leerlo
        ];
    }

    /**
     * Relación con los Mensajes de Contacto.
     * Un usuario puede enviar muchos mensajes a la plataforma.
     */
    public function mensajes(): HasMany
    {
        return $this->hasMany(Mensaje::class, 'user_id');
    }
}