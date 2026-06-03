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
        
        // Juntamos el carrito actual de la sesión (si no existe, iniciamos un array vacío)
        $carrito = session()->get('carrito', []);

        // Si el producto ya está en el carrito, sumamos la cantidad
        if(isset($carrito[$id])) {
            $carrito[$id]['cantidad']++;
        } else {
            // Si es nuevo, lo agregamos con sus datos esenciales
            $carrito[$id] = [
                "nombre" => $producto->nombre,
                "cantidad" => 1,
                "precio" => $producto->precio,
                "imagen" => $producto->imagen
            ];
        }

        // Guardamos el carrito actualizado en la sesión
        session()->put('carrito', $carrito);

        return redirect()->back()->with('exito', '¡Producto añadido al carrito!');
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