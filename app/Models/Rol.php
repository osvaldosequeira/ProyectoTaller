<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rol extends Model
{
    // Permite utilizar factorías para generar registros de prueba.
    // SoftDeletes permite realizar eliminaciones lógicas sin borrar
    // físicamente el registro de la base de datos.
    use HasFactory, SoftDeletes;

    // Especifica la tabla asociada a este modelo.
    protected $table = 'roles';

    // Define los campos que pueden ser asignados masivamente.
    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    // Relación uno a muchos:
    // Un rol puede estar asociado a múltiples usuarios.
    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'rol_id');
    }
}