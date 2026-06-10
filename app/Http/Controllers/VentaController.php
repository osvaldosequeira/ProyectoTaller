<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\VentaCabecera;

class VentaController extends Controller
{
    public function misCompras()
    {
        $ventas = VentaCabecera::where(
            'user_id',
            Auth::id()
        )
        ->orderBy('fecha', 'desc')
        ->get();

        return view(
            'mis-compras',
            compact('ventas')
        );
    }

    public function detalle($id)
    {
        $venta = VentaCabecera::with(
            'detalles.producto'
        )
        ->where(
            'user_id',
            Auth::id()
        )
        ->findOrFail($id);

        return view(
            'detalle-compra',
            compact('venta')
        );
    }
}