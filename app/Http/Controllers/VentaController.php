<?php

namespace App\Http\Controllers;

// Permite acceder a los datos enviados mediante formularios.
use Illuminate\Http\Request;

// Permite obtener información del usuario autenticado.
use Illuminate\Support\Facades\Auth;

// Modelo que representa la cabecera de una venta.
use App\Models\VentaCabecera;

// Modelo de usuarios del sistema.
use App\Models\User;

class VentaController extends Controller
{
   // Muestra el historial de compras del usuario autenticado.
public function misCompras(Request $request)
{
    // Consulta base
    $query = VentaCabecera::where(
        'user_id',
        Auth::id()
    );

    // Filtrar por ID de compra
    if ($request->filled('venta_id')) {

        $query->where(
            'id',
            $request->venta_id
        );

    }

    // Filtrar desde fecha
    if ($request->filled('desde')) {

        $query->whereDate(
            'fecha',
            '>=',
            $request->desde
        );

    }

    // Filtrar hasta fecha
    if ($request->filled('hasta')) {

        $query->whereDate(
            'fecha',
            '<=',
            $request->hasta
        );

    }

    // Obtener ventas ordenadas
    $ventas = $query
        ->orderBy('fecha', 'desc')
        ->get();

    // Enviar a la vista
    return view(
        'mis-compras',
        compact('ventas')
    );
}
    // Muestra el detalle de una compra específica del usuario.
    public function detalle($id)
    {
        // Busca la venta junto con sus detalles y productos asociados.
        $venta = VentaCabecera::with(
            'detalles.producto'
        )
        // Garantiza que la venta pertenezca al usuario autenticado.
        ->where(
            'user_id',
            Auth::id()
        )
        ->findOrFail($id);

        // Envía la venta encontrada a la vista de detalle.
        return view(
            'detalle-compra',
            compact('venta')
        );
    }

    // Muestra el listado general de ventas para el administrador.
    public function adminVentas(Request $request)
    {
        // Inicia una consulta incluyendo la relación con el usuario.
        $query = VentaCabecera::with('usuario');

        // Filtra por nombre de usuario si se recibió ese criterio.
        if ($request->filled('usuario')) {
            $query->whereHas('usuario', function ($q) use ($request) {
                $q->where(
                    'name',
                    'like',
                    '%' . $request->usuario . '%'
                );
            });
        }

        // Filtra ventas desde una fecha determinada.
        if ($request->filled('desde')) {
            $query->whereDate(
                'fecha',
                '>=',
                $request->desde
            );
        }

        // Filtra ventas hasta una fecha determinada.
        if ($request->filled('hasta')) {
            $query->whereDate(
                'fecha',
                '<=',
                $request->hasta
            );
        }

        // Obtiene las ventas ordenadas desde la más reciente.
        $ventas = $query
            ->orderBy('fecha', 'desc')
            ->get();

        // Envía el listado de ventas a la vista administrativa.
        return view(
            'backend.admin.ventas.index',
            compact('ventas')
        );
    }

    // Muestra el detalle completo de una venta para el administrador.
    public function adminDetalle($id)
    {
        // Obtiene la venta junto con el usuario y los productos vendidos.
        $venta = VentaCabecera::with(
            'usuario',
            'detalles.producto'
        )->findOrFail($id);

        // Envía la información a la vista de detalle administrativo.
        return view(
            'backend.admin.ventas.detalle',
            compact('venta')
        );
    }
}