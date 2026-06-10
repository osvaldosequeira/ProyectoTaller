<?php

namespace App\Http\Controllers;
use App\Models\Carrito;
use App\Models\CarritoDetalle;
use App\Models\Producto;
use App\Models\VentaCabecera;
use App\Models\DetalleVenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    public function agregar(Request $request, $id)
{
    $producto = Producto::findOrFail($id);

    $tamanio = $request->input('tamanio', 'Pequeña');
    $talle = $request->input('talle', 'M');
    $cantidad = (int) $request->input('cantidad', 1);

    $extras = [
        'Pequeña' => 0,
        'Mediana' => 15000,
        'Grande' => 30000
    ];

    $precioFinal = $producto->precio + ($extras[$tamanio] ?? 0);

    if ($producto->stock < $cantidad) {

        return redirect()->back()
            ->with('error', 'No hay suficiente stock disponible');
    }

    $carrito = Carrito::firstOrCreate([
        'user_id' => Auth::id()
    ]);

    $detalle = CarritoDetalle::where(
        'carrito_id',
        $carrito->id
    )
    ->where(
        'producto_id',
        $producto->id
    )
    ->where(
        'tamanio',
        $tamanio
    )
    ->where(
        'talle',
        $talle
    )
    ->first();

    if ($detalle) {

        $nuevaCantidad =
            $detalle->cantidad + $cantidad;

        if ($nuevaCantidad > $producto->stock) {

            return redirect()->back()
                ->with('error', 'Supera el stock disponible');
        }

        $detalle->cantidad = $nuevaCantidad;
        $detalle->save();

    } else {

        CarritoDetalle::create([

            'carrito_id' => $carrito->id,

            'producto_id' => $producto->id,

            'cantidad' => $cantidad,

            'precio' => $precioFinal,

            'tamanio' => $tamanio,

            'talle' => $talle
        ]);
    }

    return redirect()
        ->route('carrito.show')
        ->with('exito', 'Producto agregado');
}

    public function showCarrito()
{
    $carrito = Carrito::where(
        'user_id',
        Auth::id()
    )
    ->with('detalles.producto')
    ->first();

    $items = [];
    $total = 0;

    if($carrito){

        foreach($carrito->detalles as $detalle){

            $itemKey =
            $detalle->producto_id .
            "_" .
            $detalle->tamanio .
            "_" .
            $detalle->talle;

            $items[$itemKey] = [

                'producto_id' =>
                $detalle->producto_id,

                'nombre' =>
                $detalle->producto->nombre .
                " | Caja: ".$detalle->tamanio .
                " | Talle: ".$detalle->talle,

                'cantidad' =>
                $detalle->cantidad,

                'precio' =>
                $detalle->precio,

                'imagen' =>
                $detalle->producto->imagen,

                'tamanio' =>
                $detalle->tamanio,

                'talle' =>
                $detalle->talle
            ];

            $total +=
            $detalle->precio
            *
            $detalle->cantidad;
        }
    }

    return view(
        'comercializacion',
        [
            'carrito' => $items,
            'total' => $total
        ]
    );
}

    public function eliminar($id)
{
    $carrito = Carrito::where(
        'user_id',
        Auth::id()
    )->first();

    if($carrito){

        CarritoDetalle::where(
            'carrito_id',
            $carrito->id
        )
        ->where(
            'producto_id',
            $id
        )
        ->delete();
    }

    return back()
    ->with(
        'exito',
        'Producto eliminado'
    );
}

    public function confirmarCompra()
{
    $carrito = Carrito::where(
        'user_id',
        Auth::id()
    )
    ->with('detalles')
    ->first();

    if(
        !$carrito ||
        $carrito->detalles->isEmpty()
    ){
        return back()
        ->with(
            'error',
            'Carrito vacío'
        );
    }

    $total = 0;

    foreach($carrito->detalles as $item){

        $producto =
        Producto::find(
            $item->producto_id
        );

        if(!$producto){

            continue;
        }

        if(
            $producto->stock
            <
            $item->cantidad
        ){
            return back()
            ->with(
                'error',
                'Sin stock suficiente para '.$producto->nombre
            );
        }

        $producto->stock -=
        $item->cantidad;

        $producto->save();

        $total +=
        $item->precio
        *
        $item->cantidad;
    }

    $venta = VentaCabecera::create([

        'user_id' =>
        Auth::id(),

        'fecha' =>
        now(),

        'total' =>
        $total
    ]);

    foreach($carrito->detalles as $item){

        DetalleVenta::create([

            'venta_cabecera_id' =>
            $venta->id,

            'producto_id' =>
            $item->producto_id,

            'cantidad' =>
            $item->cantidad,

            'precio_unitario' =>
            $item->precio,

            'tamanio' =>
            $item->tamanio,

            'talle' =>
            $item->talle
        ]);
    }

    CarritoDetalle::where(
        'carrito_id',
        $carrito->id
    )->delete();

    return view('exito', [
        'compra' => true,
        'total' => $total
    ]);
}
}