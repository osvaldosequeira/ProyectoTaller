<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\VentaCabecera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    /**
     * Añade un producto al carrito guardándolo en la sesión.
     */
    public function agregar(Request $request, $id)
{
    $producto = Producto::findOrFail($id);
    $tamanio = $request->input('tamanio', 'Pequeña'); // Captura el tamaño elegido

    // Definimos los costos adicionales según el tamaño
    $extras = [
        'Pequeña' => 0,
        'Mediana' => 15000,
        'Grande'  => 30000
    ];

    $precioFinal = $producto->precio + $extras[$tamanio]; // Suma el extra al precio base
    
    $carrito = session()->get('carrito', []);

    // Creamos una clave única que combine ID y Tamaño para permitir diferentes tamaños del mismo producto
    $itemKey = $id . '_' . $tamanio;

    if(isset($carrito[$itemKey])) {
        $carrito[$itemKey]['cantidad']++;
    } else {
        $carrito[$itemKey] = [
            "nombre" => $producto->nombre . " (" . $tamanio . ")",
            "cantidad" => 1,
            "precio" => $precioFinal,
            "imagen" => $producto->imagen
        ];
    }

    session()->put('carrito', $carrito);
    return redirect()->route('carrito.show')->with('exito', '¡' . $tamanio . ' añadida con éxito!');
}

    /**
     * Muestra la página de comercialización con los datos reales de la sesión.
     */
    public function showCarrito()
    {
        $carrito = session()->get('carrito', []);
        
        // Calculamos el total de la compra sumando cada ítem
        $total = 0;
        foreach($carrito as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }

        return view('comercializacion', compact('carrito', 'total'));
    }
/**
     * Elimina un artículo completo del carrito en la sesión.
     */
    public function eliminar($id)
    {
        $carrito = session()->get('carrito', []);

        // Si el producto existe en la sesión, lo removemos con unset
        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            session()->put('carrito', $carrito);
        }

        return redirect()->back()->with('exito', '¡Artículo removido del carrito!');
    }
    /**
     * Procesa la compra e impacta en MariaDB.
     */
    public function confirmarCompra()
    {
        $carrito = session()->get('carrito', []);

        if(empty($carrito)) {
            return redirect()->back()->with('error', 'El carrito está vacío.');
        }

        $total = 0;
        foreach($carrito as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }

        // Guardamos la cabecera en la base de datos
        VentaCabecera::create([
            'user_id' => Auth::id() ?? 1, // Usuario logueado o el ID 1 de prueba
            'fecha' => now(),
            'total' => $total
        ]);

        // Vaciamos el carrito de la sesión después de comprar
        session()->forget('carrito');

        return view('exito'); // O tu vista backend/usuarios/compra-confirmada
    }
}