<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\AuthController;

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

// 5. RUTAS DEL CATÁLOGO
// Faltaba esta línea para cargar la grilla de productos desde MariaDB:
Route::get('/catalogo', [ProductoController::class, 'index'])->name('producto.index');

// Ruta para ver el detalle de la Mystery Box seleccionada
Route::get('/catalogo/{id}', [ProductoController::class, 'show'])->name('producto.show');
// 6. RUTA DE COMERCIALIZACION
Route::get('/comercializacion', [CarritoController::class, 'showCarrito'])
    ->name('carrito.show');

// 7. RUTA DEL CARRITO
Route::get('/carrito', [CarritoController::class, 'showCarrito']);

// 8. RUTA PARA AGREGAR PRODUCTOS AL CARRITO
Route::post('/carrito/agregar/{id}', [CarritoController::class, 'agregar'])
    ->name('carrito.agregar');

// 9. RUTA PARA ELIMINAR PRODUCTOS DEL CARRITO
Route::delete('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar'])
    ->name('carrito.eliminar');

// 10. RUTA PARA CONFIRMAR LA COMPRA
Route::post('/carrito/confirmar', [CarritoController::class, 'confirmarCompra'])
    ->name('carrito.confirmar');

// 11. RUTA PARA RECIBIR LOS DATOS DEL FORMULARIO
Route::post('/contacto', function (Request $request) {

    $nombre = $request->input('nombre');
    $email = $request->input('email');
    $mensaje = $request->input('mensaje');

    return view('exito', compact('nombre', 'email', 'mensaje'));
});

// ... Tus rutas anteriores de inicio, catálogo y login se mantienen exactamente igual ...

// 12. RUTAS DE ADMINISTRACIÓN PROTEGIDAS (Only Admins)
Route::middleware([\App\Http\Middleware\AdminMiddleware::class])->group(function () {
    
    // El Dashboard Principal (Página de inicio del Admin con gráficos y totales)
    Route::get('/admin/dashboard', [UsuarioController::class, 'dashboard'])->name('admin.dashboard');
    
    // Rutas que ya tenías de usuarios y roles
    Route::get('/roles', [RolController::class, 'index'])->name('roles.index');
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
    
    // CRUD / ABM de Productos (Crear, Editar, Borrar Mystery Boxes)
    Route::get('/admin/productos', [ProductoController::class, 'adminIndex'])->name('admin.productos.index');
    Route::get('/admin/productos/crear', [ProductoController::class, 'create'])->name('admin.productos.create');
    Route::post('/admin/productos', [ProductoController::class, 'store'])->name('admin.productos.store');
    Route::get('/admin/productos/{id}/editar', [ProductoController::class, 'edit'])->name('admin.productos.edit');
    Route::put('/admin/productos/{id}', [ProductoController::class, 'update'])->name('admin.productos.update');
    Route::delete('/admin/productos/{id}', [ProductoController::class, 'destroy'])->name('admin.productos.destroy');
});
// 13. RUTAS DE USUARIOS
Route::get('/usuarios', [UsuarioController::class, 'index'])
    ->name('usuarios.index');

// 14. RUTA REGISTRO
Route::get('/registro', function () {
    return view('registro');
});

// 15. RUTA LOGIN
Route::get('/login', function () {
    return view('login');
});

// 16. LOGIN REAL
Route::post('/login', [AuthController::class, 'login']);

// 17. REGISTRO REAL
Route::post('/registro', [AuthController::class, 'registro']);

// 18. LOGOUT
Route::post('/logout', [AuthController::class, 'logout']);