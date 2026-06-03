<?php

namespace App\Http\Controllers;

use App\Models\Producto; // Importante que esté el modelo
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        // Trae todos los productos de MariaDB
        $productos = Producto::all(); 

        // Retorna la vista pasando la variable para que el @forelse la pueda leer
        return view('catalogo', compact('productos'));
    }
}