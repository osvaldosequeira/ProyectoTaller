<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VentaCabecera extends Model
{
    use HasFactory;

    /**
     * El nombre de la tabla asociada al modelo.
     */
    protected $table = 'venta_cabeceras';

    /**
     * Los atributos que son asignables en masa.
     */
    protected $fillable = [
        'user_id',
        'fecha',
        'total'
    ];

    /**
     * Indica si el modelo debe mantener marcas de tiempo (created_at/updated_at).
     */
    public $timestamps = true;

    /**
     * Relación: Una cabecera de venta tiene muchos detalles de venta.
     */
    public function detalles()
    {
        return $this->hasMany(
            DetalleVenta::class, 
            'venta_cabecera_id'
        );
    }

    /**
     * Relación: Una venta pertenece a un usuario.
     * Esta es la relación que utilizamos en el dashboard para mostrar el nombre.
     */
    public function usuario()
    {
        return $this->belongsTo(
            User::class, 
            'user_id'
        );
    }
}