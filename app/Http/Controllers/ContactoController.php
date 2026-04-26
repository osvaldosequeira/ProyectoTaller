<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactoController extends Controller
{
    public function procesarFormulario(Request $request)
    {
        // Capturamos los datos del formulario (según Guía 4)
        $nombre = $request->input('nombre');
        $email = $request->input('email');
        $mensaje = $request->input('mensaje');

        // Retornamos la vista de éxito pasando los parámetros
        return view('exito', [
            'nombre' => $nombre,
            'email' => $email
        ]);
    }
}