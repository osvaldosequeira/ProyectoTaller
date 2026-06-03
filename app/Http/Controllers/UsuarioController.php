<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    /**
     * DASHBOARD: Métricas generales para Osvaldo Admin
     */
    public function dashboard()
    {
        // Conteo dinámico de la base de datos
        $totalUsuarios = User::count();
        $totalProductos = Producto::count();
        $totalAdmins = User::where('es_admin', 1)->count();
        
        // Simulación de ingresos para el Taller
        $totalVentasComerciales = 345000.00; 

        // Auditoría de registros recientes
        $ultimosUsuarios = User::orderBy('created_at', 'desc')->take(5)->get();

        return view('backend.admin.dashboard', compact('totalUsuarios', 'totalProductos', 'totalAdmins', 'totalVentasComerciales', 'ultimosUsuarios'));
    }

    /**
     * Listado de usuarios para gestión interna
     */
    public function index()
    {
        $usuarios = User::all();
        return view('backend.admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Formulario para editar datos y cambiar ROL
     */
    public function edit(User $usuario)
    {
        return view('admin.usuarios.edit', compact('usuario'));
    }

    /**
     * Actualización de datos y permisos (es_admin)
     */
    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $usuario->id,
            'es_admin' => 'required|boolean', // Permite alternar entre Cliente (0) y Admin (1)
        ]);

        $usuario->update([
            'name' => $request->name,
            'email' => $request->email,
            'es_admin' => $request->es_admin,
        ]);

        return redirect()->route('usuarios.index')->with('exito', 'Usuario actualizado con éxito.');
    }

    /**
     * Eliminación de cuenta de usuario
     */
    public function destroy(User $usuario)
    {
        // Evitar que el admin se borre a sí mismo por error
        if ($usuario->id === Auth::id()) {
            return back()->with('error', 'No podés eliminar tu propia cuenta de administrador.');
        }

        $usuario->delete();
        return redirect()->route('usuarios.index')->with('exito', 'Usuario eliminado correctamente.');
    }
}