<?php

namespace App\Http\Controllers;

use App\Models\VentaCabecera;
use App\Models\User;
use App\Models\Producto; // Tu modelo real en español
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        // Capturamos los datos que viajan desde el formulario GET
        $buscar = $request->input('buscar');
        $rol = $request->input('rol');

        // Construimos la consulta usando un Query Builder dinámico
        $usuarios = User::query()
            ->when($buscar, function ($query, $buscar) {
                return $query->where(function($q) use ($buscar) {
                    $q->where('name', 'like', "%{$buscar}%")
                      ->orWhere('email', 'like', "%{$buscar}%");
                });
            })
            ->when($rol !== null && $rol !== '', function ($query) use ($rol) {
                return $query->where('es_admin', $rol);
            })
            ->orderBy('name', 'asc')
            ->get();

        // Retornamos la vista enviando los datos compactados
        return view('backend.admin.usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('backend.admin.usuarios.crear');
    }
public function dashboard()
{
    // Métricas para los números superiores
    $totalUsuarios = User::count();
    $totalProductos = Producto::count();
    $totalAdmins = User::where('es_admin', 1)->count();
    $totalVentas = VentaCabecera::count();
    $totalVentasComerciales = VentaCabecera::sum('total');

    // Datos detallados para las tablas
    $ultimosUsuarios = User::orderBy('created_at', 'desc')->take(5)->get();
    $productosCriticos = Producto::orderBy('stock', 'asc')->take(5)->get(); // Productos con poco stock
    $ultimasVentas = VentaCabecera::with('usuario')->orderBy('created_at', 'desc')->take(5)->get();
    
    // Asumiendo que tenés un modelo Mensaje
    $ultimosMensajes = \App\Models\Mensaje::orderBy('created_at', 'desc')->take(5)->get();

    return view('backend.admin.dashboard', compact(
        'totalUsuarios', 'totalProductos', 'totalAdmins', 
        'totalVentas', 'totalVentasComerciales', 'ultimosUsuarios',
        'productosCriticos', 'ultimasVentas', 'ultimosMensajes'
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