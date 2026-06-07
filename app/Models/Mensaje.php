<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// El atributo habilita la carga de datos masiva
#[Fillable(['user_id', 'nombre', 'email', 'mensaje'])]
class Mensaje extends Model // ⚠️ ANTES DECÍA "mensajes", DEJA SÓLO "Mensaje"
{
    // Le avisamos a Laravel que la tabla en MariaDB sí es plural: 'mensajes'
    protected $table = 'mensajes';

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}