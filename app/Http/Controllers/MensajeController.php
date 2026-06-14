<?php

namespace App\Http\Controllers;

use App\Models\Mensaje; // ✅ SOLUCIÓN AL ERROR: Importación obligatoria
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Necesario para detectar si está logueado

class MensajeController extends Controller
{
    public function index(Request $request)
{
    $buscar = $request->input('buscar');
    $tipo = $request->input('tipo');

    $mensajes = Mensaje::with('usuario')
        ->when($buscar, function ($query, $buscar) {
            return $query->where(function($q) use ($buscar) {
                $q->where('nombre', 'like', "%{$buscar}%")
                  ->orWhere('email', 'like', "%{$buscar}%")
                  ->orWhere('mensaje', 'like', "%{$buscar}%");
            });
        })
        ->when($tipo, function ($query, $tipo) {
            if ($tipo === 'registrado') {
                return $query->whereNotNull('user_id'); // Filtra donde el usuario existe
            }
            if ($tipo === 'no registrado') {
                return $query->whereNull('user_id'); // Filtra donde el usuario es null
            }
        })
        ->orderBy('created_at', 'desc')
        ->get();

    return view('backend.admin.mensajes.index', compact('mensajes'));
}

    /**
     * Procesar el formulario de contacto público y guardarlo en MariaDB (Frontend)
     */
    public function storePublic(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mensaje' => 'required|string',
        ]);

        // LÓGICA INTELIGENTE: Si está logueado guarda su ID, sino guarda null (Anónimo)
        Mensaje::create([
            'user_id' => Auth::check() ? Auth::id() : null,
            'nombre' => $request->input('nombre'),
            'email' => $request->input('email'),
            'mensaje' => $request->input('mensaje'),
        ]);

        $nombre = $request->input('nombre');
        $email = $request->input('email');
        $mensaje = $request->input('mensaje');

        // Renderiza tu vista de éxito real pasando las variables
        return view('exito', compact('nombre', 'email', 'mensaje'));
    }

    /**
     * Eliminar un mensaje de la base de datos
     */
    public function destroy($id)
    {
        $mensaje = Mensaje::findOrFail($id);
        $mensaje->delete();

        return redirect()->route('admin.mensajes.index')->with('exito', 'El mensaje fue eliminado correctamente.');
    }
}