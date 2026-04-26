<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| RUTAS DE LA APLICACION - ESENCIA RETRO
|--------------------------------------------------------------------------
*/

// 1. RUTA DE LA PAGINA PRINCIPAL (INICIO)
Route::get('/', function () {
    return view('principal');
});

// 2. RUTA DE QUIENES SOMOS (NOSOTROS)
Route::get('/quienes-somos', function () {
    return view('quienes-somos');
});

// 3. RUTA DE TERMINOS Y CONDICIONES
Route::get('/terminos', function () {
    return view('terminos');
});

// ESTA RUTA ES PARA MOSTRAR EL FORMULARIO
Route::get('/contacto', function () {
    return view('contacto');
});

// ESTA RUTA ES PARA RECIBIR LOS DATOS Y MOSTRAR ÉXITO
Route::post('/contacto', function (Illuminate\Http\Request $request) {
    $nombre = $request->input('nombre');
    $email = $request->input('email');
    $mensaje = $request->input('mensaje');

    // AQUÍ CONECTA CON EXITO.BLADE.PHP
    return view('exito', compact('nombre', 'email', 'mensaje'));
});