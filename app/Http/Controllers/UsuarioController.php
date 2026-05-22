<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Rol;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::with('rol')->get();

        return view('backend.admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Rol::all();

        return view('backend.admin.usuarios.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|unique:usuarios',
            'password' => 'required|min:8|confirmed',
            'rol_id' => 'required|exists:roles,id',
        ]);

        Usuario::create($request->only([
            'nombre',
            'email',
            'password',
            'rol_id'
        ]));

        return redirect()->route('usuarios.index')
                         ->with('exito', 'Usuario creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        return view('backend.admin.usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuario)
    {
        $roles = Rol::all();

        return view('backend.admin.usuarios.edit', compact('usuario', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|unique:usuarios,email,' . $usuario->id,
            'rol_id' => 'required|exists:roles,id',
        ]);

        $usuario->update($request->only([
            'nombre',
            'email',
            'rol_id'
        ]));

        return redirect()->route('usuarios.index')
                         ->with('exito', 'Usuario actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        $usuario->delete();

        return redirect()->route('usuarios.index')
                         ->with('exito', 'Usuario eliminado correctamente');
    }
}