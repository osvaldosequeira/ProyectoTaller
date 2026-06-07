<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Producto; // Tu modelo real en español
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        return view('backend.admin.usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('backend.admin.usuarios.crear');
    }
public function dashboard()
    {
        $totalUsuarios = User::count();
        $totalProductos = Producto::count(); // Cuenta tus Mystery Boxes
        $totalAdmins = User::where('es_admin', 1)->count();
        $totalVentasComerciales = 345000.00; // Podés dejarlo estático por ahora para el taller

        $ultimosUsuarios = User::orderBy('created_at', 'desc')->take(5)->get();

        return view('backend.admin.dashboard', compact(
            'totalUsuarios', 'totalProductos', 'totalAdmins', 
            'totalVentasComerciales', 'ultimosUsuarios'
        ));
    }
 public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'es_admin' => 'required|in:0,1',
        ], [
            'password.min' => 'La contraseña es muy corta. Debe tener como mínimo 8 caracteres.',
            'email.unique' => 'Este correo electrónico ya está registrado en Esencia Retro.',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'es_admin' => (int) $request->es_admin, // Fuerza el valor a entero (0 o 1)
        ]);

        return redirect()->route('usuarios.index')->with('exito', 'Nuevo usuario creado correctamente desde el panel.');
    }

    // MÉTODO ACTUALIZAR USUARIO EXISTENTE
    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $id,
            'es_admin' => 'required|in:0,1',
        ], [
            'email.unique' => 'Este correo ya pertenece a otro usuario.',
        ]);

        $usuario->update([
            'name' => $request->name,
            'email' => $request->email,
            'es_admin' => (int) $request->es_admin, // Fuerza el cambio de rol a entero
        ]);

        return redirect()->route('usuarios.index')->with('exito', 'Usuario y rol actualizados correctamente.');
    }
    // EDITAR: Buscamos por ID explícito para evitar fallos de inyección de rutas
    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        return view('backend.admin.usuarios.edit', compact('usuario'));
    }

   
    public function destroy(User $usuario)
    {
        if ($usuario->id === Auth::id()) {
            return back()->with('error', 'Operación cancelada: No podés eliminar tu propia cuenta de administrador activa.');
        }

        $usuario->delete();
        return redirect()->route('usuarios.index')->with('exito', 'Usuario eliminado correctamente.');
    }
}