<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\VentaCabecera;
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

        if($producto->stock < $cantidad){
            return redirect()->back()
            ->with('error','No hay suficiente stock disponible');
        }

        $carrito = session()->get('carrito', []);

        $itemKey = $id . "_" . $tamanio . "_" . $talle;

        if(isset($carrito[$itemKey])){

            $nuevaCantidad =
            $carrito[$itemKey]['cantidad'] + $cantidad;

            if($nuevaCantidad > $producto->stock){

                return redirect()->back()
                ->with('error','Supera el stock disponible');

            }

            $carrito[$itemKey]['cantidad'] += $cantidad;

        }else{

            $carrito[$itemKey] = [

                "producto_id" => $producto->id,

                "nombre" =>
                $producto->nombre .
                " | Caja: ".$tamanio .
                " | Talle: ".$talle,

                "cantidad" => $cantidad,

                "precio" => $precioFinal,

                "imagen" => $producto->imagen,

                "tamanio" => $tamanio,

                "talle" => $talle

            ];
        }

        session()->put('carrito',$carrito);

        return redirect()
        ->route('carrito.show')
        ->with('exito','Producto agregado');
    }

    public function showCarrito()
    {
        $carrito = session()->get('carrito', []);

        $total = 0;

        foreach($carrito as $item){

            $total +=
            $item['precio']
            *
            $item['cantidad'];

        }

        return view(
            'comercializacion',
            compact(
                'carrito',
                'total'
            )
        );
    }

    public function eliminar($id)
    {
        $carrito = session()->get('carrito', []);

        if(isset($carrito[$id])){

            unset($carrito[$id]);

            session()->put(
                'carrito',
                $carrito
            );
        }

        return back()
        ->with(
            'exito',
            'Producto eliminado'
        );
    }

    public function confirmarCompra()
    {
        $carrito =
        session()->get(
            'carrito',
            []
        );

        if(empty($carrito)){

            return back()
            ->with(
                'error',
                'Carrito vacío'
            );
        }

        $total = 0;

        foreach($carrito as $item){

            $producto =
            Producto::find(
                $item['producto_id']
            );

            if(!$producto){

                continue;

            }

            if(
                $producto->stock
                <
                $item['cantidad']
            ){

                return back()
                ->with(
                    'error',
                    'Sin stock suficiente para '.$producto->nombre
                );
            }

            $producto->stock -=
            $item['cantidad'];

            $producto->save();

            $total +=
            $item['precio']
            *
            $item['cantidad'];
        }

        VentaCabecera::create([

            'user_id' =>
            Auth::id() ?? 1,

            'fecha' =>
            now(),

            'total' =>
            $total

        ]);

        session()->forget(
            'carrito'
        );

        return view('exito', [
    'compra' => true,
    'total' => $total
        ]);
    }
}