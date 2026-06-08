<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Muestra la grilla general del catálogo.
     */
    public function index()
    {
        $productos = Producto::all();
        return view('catalogo', compact('productos'));
    }

    /**
     * Muestra el panel de administración de productos.
     */
    public function adminIndex()
    {
        $productos = Producto::all();
        return view('backend.admin.productos.index', compact('productos'));
    }

    /**
     * Muestra el formulario para dar de alta una nueva Mystery Box.
     */
    public function create()
    {
        return view('backend.admin.productos.crear');
    }

    /**
     * Almacena una nueva Mystery Box en la base de datos MariaDB.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'      => 'required|string|max:255',
            'precio'      => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'imagen'      => 'required|string',
            'descripcion' => 'required|string',
        ]);

        Producto::create([
            'nombre'      => $request->nombre,
            'precio'      => $request->precio,
            'stock'       => $request->stock,
            'imagen'      => $request->imagen,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('admin.productos.index')
            ->with('exito', 'Mystery Box creada con éxito.');
    }

    /**
     * Muestra el formulario para editar una Mystery Box existente.
     */
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);

        return view(
            'backend.admin.productos.editar',
            compact('producto')
        );
    }

    /**
     * Actualiza los datos de la Mystery Box en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $request->validate([
            'nombre'      => 'required|string|max:255',
            'precio'      => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'imagen'      => 'required|string',
            'descripcion' => 'required|string',
        ]);

        $producto->update([
            'nombre'      => $request->nombre,
            'precio'      => $request->precio,
            'stock'       => $request->stock,
            'imagen'      => $request->imagen,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('admin.productos.index')
            ->with('exito', 'Mystery Box actualizada con éxito.');
    }

    /**
     * Elimina una Mystery Box del catálogo.
     */
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);

        $producto->delete();

        return redirect()->route('admin.productos.index')
            ->with('exito', 'Mystery Box eliminada correctamente.');
    }

    /**
     * Muestra el detalle interactivo de una Mystery Box.
     */
    public function show($id)
    {
        $producto = Producto::findOrFail($id);

        $remerasPosibles = match (true) {

            str_contains(strtolower($producto->nombre), 'champions') => [

                ['equipo' => 'Real Madrid 2002', 'tipo' => 'Titular (Zidane)', 'rareza' => 'Mítica'],
                ['equipo' => 'Milan 1989', 'tipo' => 'Titular (Van Basten)', 'rareza' => 'Legendaria'],
                ['equipo' => 'Liverpool 2005', 'tipo' => 'Final Estambul', 'rareza' => 'Épica'],
                ['equipo' => 'Barcelona 2009', 'tipo' => 'Final Roma (Messi)', 'rareza' => 'Legendaria'],
                ['equipo' => 'Manchester United 1999', 'tipo' => 'Final Camp Nou', 'rareza' => 'Mítica'],
                ['equipo' => 'Bayern Munich 2001', 'tipo' => 'Titular Clásica', 'rareza' => 'Épica'],
                ['equipo' => 'Ajax 1995', 'tipo' => 'Generación Dorada', 'rareza' => 'Mítica'],
                ['equipo' => 'Inter 2010', 'tipo' => 'Edición Triplete', 'rareza' => 'Épica'],
                ['equipo' => 'Chelsea 2012', 'tipo' => 'Final Munich', 'rareza' => 'Épica'],
                ['equipo' => 'Borussia Dortmund 1997', 'tipo' => 'Titular Neón', 'rareza' => 'Mítica'],
                ['equipo' => 'Porto 2004', 'tipo' => 'Edición Mourinho', 'rareza' => 'Épica'],
                ['equipo' => 'Juventus 1996', 'tipo' => 'Titular (Del Piero)', 'rareza' => 'Legendaria'],
                ['equipo' => 'Marseille 1993', 'tipo' => 'Titular Clásica', 'rareza' => 'Épica'],
                ['equipo' => 'Benfica 1962', 'tipo' => 'Retro (Eusébio)', 'rareza' => 'Legendaria'],
                ['equipo' => 'Nottingham Forest 1979', 'tipo' => 'Retro Legend', 'rareza' => 'Legendaria'],
            ],

            str_contains(strtolower($producto->nombre), 'mundial') => [

                ['equipo' => 'Argentina 1994', 'tipo' => 'Suplente (Maradona)', 'rareza' => 'Legendaria'],
                ['equipo' => 'Brasil 1970', 'tipo' => 'Titular (Pelé)', 'rareza' => 'Legendaria'],
                ['equipo' => 'Alemania 1990', 'tipo' => 'Titular Clásica', 'rareza' => 'Mítica'],
                ['equipo' => 'Francia 1998', 'tipo' => 'Titular (Zidane)', 'rareza' => 'Legendaria'],
                ['equipo' => 'Holanda 1974', 'tipo' => 'Naranja Mecánica', 'rareza' => 'Mítica'],
                ['equipo' => 'España 2010', 'tipo' => 'Final Sudáfrica', 'rareza' => 'Épica'],
                ['equipo' => 'Inglaterra 1966', 'tipo' => 'Titular Retro', 'rareza' => 'Legendaria'],
                ['equipo' => 'Italia 1982', 'tipo' => 'Azzurra Clásica', 'rareza' => 'Mítica'],
                ['equipo' => 'Uruguay 1950', 'tipo' => 'Maracanazo Retro', 'rareza' => 'Legendaria'],
                ['equipo' => 'Argentina 1986', 'tipo' => 'Titular (Le Coq)', 'rareza' => 'Legendaria'],
                ['equipo' => 'Nigeria 1994', 'tipo' => 'Titular Águilas', 'rareza' => 'Épica'],
                ['equipo' => 'Camerún 2002', 'tipo' => 'Sin mangas (Eto\'o)', 'rareza' => 'Mítica'],
                ['equipo' => 'México 1998', 'tipo' => 'Calendario Azteca', 'rareza' => 'Legendaria'],
                ['equipo' => 'Colombia 1990', 'tipo' => 'Roja (Valderrama)', 'rareza' => 'Mítica'],
                ['equipo' => 'Croacia 1998', 'tipo' => 'A cuadros Clásica', 'rareza' => 'Épica'],
            ],

            default => [
                ['equipo' => 'River Plate 1996', 'tipo' => 'Titular (Enzo F.)', 'rareza' => 'Legendaria'],
                ['equipo' => 'Boca Juniors 2000', 'tipo' => 'Titular (Riquelme)', 'rareza' => 'Legendaria'],
                ['equipo' => 'Independiente 1972', 'tipo' => 'Rey de Copas', 'rareza' => 'Legendaria'],
                ['equipo' => 'Peñarol 1966', 'tipo' => 'Aurinegra Clásica', 'rareza' => 'Legendaria'],
                ['equipo' => 'Flamengo 1981', 'tipo' => 'Titular (Zico)', 'rareza' => 'Legendaria'],
                ['equipo' => 'Santos 1962', 'tipo' => 'Blanca (Pelé)', 'rareza' => 'Legendaria'],
            ],
        };

        return view(
            'producto-detalle',
            compact('producto', 'remerasPosibles')
        );
    }
}