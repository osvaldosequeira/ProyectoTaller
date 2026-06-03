<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProductoController;

use App\Http\Controllers\CarritoController;

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

// 4. RUTA DE CONTACTO (FORMULARIO)
Route::get('/contacto', function () {
    return view('contacto');
});

// 5. RUTA DE CATALOGO (Corregida para conectarse con MariaDB)
Route::get('/catalogo', [ProductoController::class, 'index']);

// 6. RUTA DE COMERCIALIZACION
Route::get('/comercializacion', function () {
    return view('comercializacion');
});



// Cambiamos la ruta de comercialización para que pase por el controlador
Route::get('/comercializacion', [CarritoController::class, 'showCarrito'])->name('carrito.show');

// Ruta tipo POST para añadir el producto al carrito desde el botón del catálogo
Route::post('/carrito/agregar/{id}', [CarritoController::class, 'agregar'])->name('carrito.agregar');

// Ruta para finalizar la compra
Route::post('/carrito/confirmar', [CarritoController::class, 'confirmarCompra'])->name('carrito.confirmar');

// 8. RUTA PARA RECIBIR LOS DATOS DEL FORMULARIO
Route::post('/contacto', function (Request $request) {

    $nombre = $request->input('nombre');
    $email = $request->input('email');
    $mensaje = $request->input('mensaje');

    // MUESTRA LA VISTA EXITO.BLADE.PHP
    return view('exito', compact('nombre', 'email', 'mensaje'));
});

// 9. RUTAS DE ROLES
Route::get('/roles', [RolController::class, 'index'])
    ->name('roles.index');

// 10. RUTAS DE USUARIOS
Route::get('/usuarios', [UsuarioController::class, 'index'])
    ->name('usuarios.index');