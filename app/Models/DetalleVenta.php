<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetalleVenta extends Model
{
    // Permite utilizar factorías para generar registros de prueba.
    use HasFactory;

    // Especifica la tabla asociada a este modelo.
    protected $table = 'detalle_ventas';

    // Define los campos que pueden ser asignados masivamente.
    protected $fillable = [
        'venta_cabecera_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
        'tamanio',
        'talle'
    ];

    // Relación muchos a uno:
    // Cada detalle de venta pertenece a una venta principal.
    public function venta()
    {
        return $this->belongsTo(
            VentaCabecera::class,
            'venta_cabecera_id'
        );
    }

    // Relación muchos a uno:
    // Cada detalle de venta está asociado a un producto.
    public function producto()
    {
        return $this->belongsTo(
            Producto::class,
            'producto_id'
        );
    }
}