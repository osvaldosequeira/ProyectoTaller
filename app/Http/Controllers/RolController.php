<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Rol::all();

        return view('backend.admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:50|unique:roles',
            'descripcion' => 'nullable|string|max:255',
        ]);

        Rol::create($request->only([
            'nombre',
            'descripcion'
        ]));

        return redirect()->route('roles.index')
                         ->with('exito', 'Rol creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rol $rol)
    {
        return view('backend.admin.roles.show', compact('rol'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rol $rol)
    {
        return view('backend.admin.roles.edit', compact('rol'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rol $rol)
    {
        $request->validate([
            'nombre' => 'required|string|max:50|unique:roles,nombre,' . $rol->id,
            'descripcion' => 'nullable|string|max:255',
        ]);

        $rol->update($request->only([
            'nombre',
            'descripcion'
        ]));

        return redirect()->route('roles.index')
                         ->with('exito', 'Rol actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rol $rol)
    {
        $rol->delete();

        return redirect()->route('roles.index')
                         ->with('exito', 'Rol eliminado correctamente');
    }
}