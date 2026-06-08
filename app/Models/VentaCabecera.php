<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VentaCabecera extends Model
{
    use HasFactory;

    protected $table = 'venta_cabeceras';

    protected $fillable = [
        'user_id',
        'fecha',
        'total'
    ];

    public $timestamps = true;
}