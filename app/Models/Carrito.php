<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    // Especifica la tabla asociada a este modelo.
    protected $table = 'carritos';

    // Define los campos que pueden ser asignados masivamente.
    protected $fillable = [
        'user_id'
    ];

    // Relación uno a muchos:
    // Un carrito puede tener múltiples detalles o productos agregados.
    public function detalles()
    {
        return $this->hasMany(
            CarritoDetalle::class,
            'carrito_id'
        );
    }

    // Relación muchos a uno:
    // Un carrito pertenece a un único usuario.
    public function usuario()
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }
}