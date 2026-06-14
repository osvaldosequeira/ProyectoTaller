<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\VentaCabecera;
use App\Models\User;

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

    public function adminVentas(Request $request)
    {
        $query = VentaCabecera::with('usuario');

        if ($request->filled('usuario')) {
            $query->whereHas('usuario', function ($q) use ($request) {
                $q->where(
                    'name',
                    'like',
                    '%' . $request->usuario . '%'
                );
            });
        }

        if ($request->filled('desde')) {
            $query->whereDate(
                'fecha',
                '>=',
                $request->desde
            );
        }

        if ($request->filled('hasta')) {
            $query->whereDate(
                'fecha',
                '<=',
                $request->hasta
            );
        }

        $ventas = $query
            ->orderBy('fecha', 'desc')
            ->get();

        return view(
            'backend.admin.ventas.index',
            compact('ventas')
        );
    }

    public function adminDetalle($id)
    {
        $venta = VentaCabecera::with(
            'usuario',
            'detalles.producto'
        )->findOrFail($id);

        return view(
            'backend.admin.ventas.detalle',
            compact('venta')
        );
    }
}