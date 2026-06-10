<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetalleVenta extends Model
{
    use HasFactory;

    protected $table = 'detalle_ventas';

    protected $fillable = [
        'venta_cabecera_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
        'tamanio',
        'talle'
    ];

    public function venta()
    {
        return $this->belongsTo(
            VentaCabecera::class,
            'venta_cabecera_id'
        );
    }

    public function producto()
    {
        return $this->belongsTo(
            Producto::class,
            'producto_id'
        );
    }
}