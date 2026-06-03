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
| RUTAS DE LA APLICACIÓN - ESENCIA RETRO
|--------------------------------------------------------------------------
*/

// --- 1. RUTAS PÚBLICAS (ACCESO GLOBAL) ---
Route::get('/', function () { return view('principal'); });
Route::get('/quienes-somos', function () { return view('quienes-somos'); });
Route::get('/terminos', function () { return view('terminos'); });
Route::get('/contacto', function () { return view('contacto'); });

// --- 2. RUTAS DE AUTENTICACIÓN ---
Route::get('/login', function () { return view('login'); })->name('login');
Route::get('/registro', function () { return view('registro'); })->name('registro');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/registro', [AuthController::class, 'registro']);
Route::post('/logout', [AuthController::class, 'logout']);

// --- 3. RUTAS DEL CATÁLOGO ---
Route::get('/catalogo', [ProductoController::class, 'index'])->name('producto.index');
Route::get('/catalogo/{id}', [ProductoController::class, 'show'])->name('producto.show');

// --- 4. RUTAS DEL CARRITO Y COMERCIALIZACIÓN ---
Route::get('/comercializacion', [CarritoController::class, 'showCarrito'])->name('carrito.show');
Route::post('/carrito/agregar/{id}', [CarritoController::class, 'agregar'])->name('carrito.agregar');
Route::delete('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
Route::post('/carrito/confirmar', [CarritoController::class, 'confirmarCompra'])->name('carrito.confirmar');

// --- 5. PROCESAMIENTO DE CONTACTO ---
Route::post('/contacto', function (Request $request) {
    $nombre = $request->input('nombre');
    $email = $request->input('email');
    $mensaje = $request->input('mensaje');
    return view('exito', compact('nombre', 'email', 'mensaje'));
});

// --- 6. RUTAS DE ADMINISTRACIÓN PROTEGIDAS (SOLO ADMINS) ---
Route::middleware([\App\Http\Middleware\AdminMiddleware::class])->group(function () {
    
    // Dashboard Principal
    Route::get('/admin/dashboard', [UsuarioController::class, 'dashboard'])->name('admin.dashboard');
    
    // Gestión de Usuarios (ABM Simplificado)
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/{usuario}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{usuario}', [UsuarioController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{usuario}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');
    
    // Gestión de Productos (ABM de Mystery Boxes)
    Route::get('/admin/productos', [ProductoController::class, 'adminIndex'])->name('admin.productos.index');
    Route::get('/admin/productos/crear', [ProductoController::class, 'create'])->name('admin.productos.create');
    Route::post('/admin/productos', [ProductoController::class, 'store'])->name('admin.productos.store');
    Route::get('/admin/productos/{id}/editar', [ProductoController::class, 'edit'])->name('admin.productos.edit');
    Route::put('/admin/productos/{id}', [ProductoController::class, 'update'])->name('admin.productos.update');
    Route::delete('/admin/productos/{id}', [ProductoController::class, 'destroy'])->name('admin.productos.destroy');

    // Roles (Opcional, si decidís mantener la vista por separado)
    Route::get('/roles', [RolController::class, 'index'])->name('roles.index');
});