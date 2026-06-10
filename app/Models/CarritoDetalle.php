<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarritoDetalle extends Model
{
    protected $table = 'carrito_detalles';

    protected $fillable = [
        'carrito_id',
        'producto_id',
        'cantidad',
        'precio',
        'tamanio',
        'talle'
    ];

    public function producto()
    {
        return $this->belongsTo(
            Producto::class,
            'producto_id'
        );
    }

    public function carrito()
    {
        return $this->belongsTo(
            Carrito::class,
            'carrito_id'
        );
    }
}