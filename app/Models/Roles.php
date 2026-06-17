<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rol extends Model
{
    // Permite utilizar factorías para generar registros de prueba.
    // SoftDeletes permite realizar eliminaciones lógicas,
    // conservando el registro en la base de datos.
    use HasFactory, SoftDeletes;

    // Especifica la tabla asociada a este modelo.
    protected $table = 'roles';

    // Define los campos que pueden ser asignados masivamente.
    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    // Relación uno a muchos:
    // Un rol puede estar asignado a varios usuarios.
    // La clave foránea utilizada es rol_id.
    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'rol_id');
    }
}