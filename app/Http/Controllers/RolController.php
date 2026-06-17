<?php

namespace App\Http\Controllers;

// Modelo que representa los roles del sistema.
use App\Models\Rol;

// Permite acceder a los datos enviados mediante formularios.
use Illuminate\Http\Request;

class RolController extends Controller
{
    /**
     * Muestra el listado completo de roles registrados.
     */
    public function index()
    {
        // Obtiene todos los roles almacenados en la base de datos.
        $roles = Rol::all();

        // Envía los roles a la vista de listado.
        return view('backend.admin.roles.index', compact('roles'));
    }

    /**
     * Muestra el formulario para crear un nuevo rol.
     */
    public function create()
    {
        // Retorna la vista con el formulario de creación.
        return view('backend.admin.roles.create');
    }

    /**
     * Guarda un nuevo rol en la base de datos.
     */
    public function store(Request $request)
    {
        // Valida los datos recibidos desde el formulario.
        $request->validate([
            // El nombre es obligatorio, debe ser texto,
            // tener máximo 50 caracteres y no repetirse.
            'nombre' => 'required|string|max:50|unique:roles',

            // La descripción es opcional.
            'descripcion' => 'nullable|string|max:255',
        ]);

        // Crea el nuevo rol utilizando únicamente
        // los campos permitidos.
        Rol::create($request->only([
            'nombre',
            'descripcion'
        ]));

        // Redirige al listado mostrando mensaje de éxito.
        return redirect()->route('roles.index')
                         ->with('exito', 'Rol creado correctamente');
    }

    /**
     * Muestra la información de un rol específico.
     */
    public function show(Rol $rol)
    {
        // Envía el rol seleccionado a la vista de detalle.
        return view('backend.admin.roles.show', compact('rol'));
    }

    /**
     * Muestra el formulario de edición de un rol.
     */
    public function edit(Rol $rol)
    {
        // Envía el rol a la vista para editar sus datos.
        return view('backend.admin.roles.edit', compact('rol'));
    }

    /**
     * Actualiza los datos de un rol existente.
     */
    public function update(Request $request, Rol $rol)
    {
        // Valida los datos enviados.
        $request->validate([
            // El nombre debe seguir siendo único,
            // excepto para el propio rol que se está editando.
            'nombre' => 'required|string|max:50|unique:roles,nombre,' . $rol->id,

            // La descripción es opcional.
            'descripcion' => 'nullable|string|max:255',
        ]);

        // Actualiza únicamente los campos permitidos.
        $rol->update($request->only([
            'nombre',
            'descripcion'
        ]));

        // Redirige al listado con mensaje de éxito.
        return redirect()->route('roles.index')
                         ->with('exito', 'Rol actualizado correctamente');
    }

    /**
     * Elimina un rol de la base de datos.
     */
    public function destroy(Rol $rol)
    {
        // Elimina el registro seleccionado.
        $rol->delete();

        // Regresa al listado informando que la operación fue exitosa.
        return redirect()->route('roles.index')
                         ->with('exito', 'Rol eliminado correctamente');
    }
}