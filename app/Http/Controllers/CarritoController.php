<?php

namespace App\Http\Controllers;

// Modelo que representa el carrito principal del usuario.
use App\Models\Carrito;

// Modelo que almacena los productos agregados al carrito.
use App\Models\CarritoDetalle;

// Modelo de productos de la tienda.
use App\Models\Producto;

// Modelo que representa la cabecera de una venta.
use App\Models\VentaCabecera;

// Modelo que almacena el detalle de cada producto vendido.
use App\Models\DetalleVenta;

// Permite acceder a los datos enviados mediante formularios.
use Illuminate\Http\Request;

// Permite obtener información del usuario autenticado.
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    // Agrega un producto al carrito del usuario.
    public function agregar(Request $request, $id)
{
    // Busca el producto por su ID.
    // Si no existe Laravel genera automáticamente un error 404.
    $producto = Producto::findOrFail($id);

    // Obtiene los valores enviados desde el formulario.
    $tamanio = $request->input('tamanio', 'Pequeña');
    $talle = $request->input('talle', 'M');
    $cantidad = (int) $request->input('cantidad', 1);

    // Define el costo adicional según el tamaño seleccionado.
    $extras = [
        'Pequeña' => 0,
        'Mediana' => 15000,
        'Grande' => 30000
    ];

    // Calcula el precio final sumando el precio base
    // más el adicional correspondiente al tamaño.
    $precioFinal = $producto->precio + ($extras[$tamanio] ?? 0);

    // Verifica que exista suficiente stock antes de agregar.
    if ($producto->stock < $cantidad) {

        return redirect()->back()
            ->with('error', 'No hay suficiente stock disponible');
    }

    // Busca el carrito del usuario autenticado.
    // Si no existe lo crea automáticamente.
    $carrito = Carrito::firstOrCreate([
        'user_id' => Auth::id()
    ]);

    // Busca si el mismo producto con igual tamaño y talle
    // ya existe dentro del carrito.
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

    // Si ya existe un registro previo.
    if ($detalle) {

        // Calcula la nueva cantidad acumulada.
        $nuevaCantidad =
            $detalle->cantidad + $cantidad;

        // Verifica nuevamente el stock disponible.
        if ($nuevaCantidad > $producto->stock) {

            return redirect()->back()
                ->with('error', 'Supera el stock disponible');
        }

        // Actualiza la cantidad existente.
        $detalle->cantidad = $nuevaCantidad;
        $detalle->save();

    } else {

        // Si no existe previamente, crea un nuevo detalle.
        CarritoDetalle::create([

            'carrito_id' => $carrito->id,

            'producto_id' => $producto->id,

            'cantidad' => $cantidad,

            'precio' => $precioFinal,

            'tamanio' => $tamanio,

            'talle' => $talle
        ]);
    }

    // Redirige al carrito mostrando mensaje de éxito.
    return redirect()
        ->route('carrito.show')
        ->with('exito', 'Producto agregado');
}

    // Muestra el contenido completo del carrito.
    public function showCarrito()
{
    // Obtiene el carrito del usuario junto con
    // los productos relacionados.
    $carrito = Carrito::where(
        'user_id',
        Auth::id()
    )
    ->with('detalles.producto')
    ->first();

    // Arreglo que almacenará los productos para la vista.
    $items = [];

    // Acumulador del total de la compra.
    $total = 0;

    // Verifica que exista un carrito.
    if($carrito){

        // Recorre todos los productos agregados.
        foreach($carrito->detalles as $detalle){

            // Genera una clave única considerando
            // producto, tamaño y talle.
            $itemKey =
            $detalle->producto_id .
            "_" .
            $detalle->tamanio .
            "_" .
            $detalle->talle;

            // Construye el arreglo que será enviado a la vista.
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

            // Calcula el total acumulado del carrito.
            $total +=
            $detalle->precio
            *
            $detalle->cantidad;
        }
    }

    // Envía la información a la vista comercializacion.
    return view(
        'comercializacion',
        [
            'carrito' => $items,
            'total' => $total
        ]
    );
}

    // Elimina un producto del carrito.
    public function eliminar($id)
{
    // Obtiene el carrito del usuario autenticado.
    $carrito = Carrito::where(
        'user_id',
        Auth::id()
    )->first();

    // Verifica que exista un carrito.
    if($carrito){

        // Elimina el producto seleccionado.
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

    // Regresa a la página anterior.
    return back()
    ->with(
        'exito',
        'Producto eliminado'
    );
}

    // Confirma la compra y registra la venta.
    public function confirmarCompra()
{
    // Obtiene el carrito junto con sus detalles.
    $carrito = Carrito::where(
        'user_id',
        Auth::id()
    )
    ->with('detalles')
    ->first();

    // Verifica que el carrito exista y tenga productos.
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

    // Variable que almacenará el total de la venta.
    $total = 0;

    // Recorre todos los productos del carrito.
    foreach($carrito->detalles as $item){

        // Busca el producto correspondiente.
        $producto =
        Producto::find(
            $item->producto_id
        );

        // Si el producto fue eliminado continúa con el siguiente.
        if(!$producto){

            continue;
        }

        // Verifica que exista stock suficiente.
      if(
    $producto->stock
    <
    $item->cantidad
){
    dd('ENTRO AL IF DE STOCK');
}

        // Descuenta del stock la cantidad comprada.
        $producto->stock -=
        $item->cantidad;

        // Guarda el nuevo stock en la base de datos.
        $producto->save();

        // Acumula el total de la venta.
        $total +=
        $item->precio
        *
        $item->cantidad;
    }

    // Crea la cabecera de la venta.
    $venta = VentaCabecera::create([

        'user_id' =>
        Auth::id(),

        'fecha' =>
        now(),

        'total' =>
        $total
    ]);

    // Registra cada producto vendido en el detalle.
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

    // Vacía el carrito una vez finalizada la compra.
    CarritoDetalle::where(
        'carrito_id',
        $carrito->id
    )->delete();

    // Muestra la vista de compra exitosa.
    return view('exito', [
        'compra' => true,
        'total' => $total
    ]);
}
}