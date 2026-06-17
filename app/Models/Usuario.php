<?php

namespace App\Models;

// Clase base de autenticación de Laravel.
// Permite que este modelo pueda iniciar sesión.
use Illuminate\Foundation\Auth\User as Authenticatable;

// Permite utilizar factorías para generar registros de prueba.
use Illuminate\Database\Eloquent\Factories\HasFactory;

// Permite enviar notificaciones al usuario.
use Illuminate\Notifications\Notifiable;

// Permite realizar eliminaciones lógicas.
use Illuminate\Database\Eloquent\SoftDeletes;

class Usuario extends Authenticatable
{
    // HasFactory permite generar datos de prueba.
    // Notifiable habilita el sistema de notificaciones.
    // SoftDeletes evita eliminar físicamente los registros.
    use HasFactory, Notifiable, SoftDeletes;

    // Especifica la tabla asociada a este modelo.
    protected $table = 'usuarios';

    // Define los campos que pueden ser asignados masivamente.
    protected $fillable = [
        'nombre',
        'email',
        'password',
        'rol_id'
    ];

    // Define los atributos que no deben mostrarse
    // al serializar el modelo.
    protected $hidden = [
        'password',
        'remember_token'
    ];

    // Define conversiones automáticas de atributos.
    protected function casts(): array
    {
        return [
            // Laravel almacena automáticamente la contraseña
            // utilizando un hash seguro.
            'password' => 'hashed',
        ];
    }

    // Relación muchos a uno:
    // Cada usuario pertenece a un único rol.
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }
}