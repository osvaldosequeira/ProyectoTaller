<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarritoDetalle extends Model
{
    // Especifica la tabla asociada a este modelo.
    protected $table = 'carrito_detalles';

    // Define los campos que pueden ser asignados masivamente.
    protected $fillable = [
        'carrito_id',
        'producto_id',
        'cantidad',
        'precio',
        'tamanio',
        'talle'
    ];

    // Relación muchos a uno:
    // Cada detalle del carrito pertenece a un producto.
    public function producto()
    {
        return $this->belongsTo(
            Producto::class,
            'producto_id'
        );
    }

    // Relación muchos a uno:
    // Cada detalle pertenece a un carrito específico.
    public function carrito()
    {
        return $this->belongsTo(
            Carrito::class,
            'carrito_id'
        );
    }
}