<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    // Permite utilizar factorías para generar registros de prueba.
    // SoftDeletes permite realizar eliminaciones lógicas sin borrar
    // físicamente el registro de la base de datos.
    use HasFactory, SoftDeletes;

    // Especifica la tabla asociada a este modelo.
    protected $table = 'productos';

    // Define los campos que pueden ser asignados masivamente.
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'imagen'
    ];
}