<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MensajeController; // ✅ IMPORTACIÓN AGREGADA

/*
|--------------------------------------------------------------------------
| RUTAS DE LA APLICACIÓN - ESENCIA RETRO (VERSION FINAL CORREGIDA)
|--------------------------------------------------------------------------
*/

// --- 1. RUTAS PÚBLICAS (ACCESO GLOBAL) ---
Route::get('/', function () { return view('principal'); })->name('home');
Route::get('/quienes-somos', function () { return view('quienes-somos'); })->name('quienes-somos');
Route::get('/terminos', function () { return view('terminos'); })->name('terminos');
Route::get('/contacto', function () { return view('contacto'); })->name('contacto');

// --- 2. RUTAS DE AUTENTICACIÓN ---
Route::get('/login', function () { return view('login'); })->name('login');
Route::get('/registro', function () { return view('registro'); })->name('registro');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/registro', [AuthController::class, 'registro']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- 3. RUTAS DEL CATÁLOGO PÚBLICO ---
Route::get('/catalogo', [ProductoController::class, 'index'])->name('admin.productos.index');
Route::get('/catalogo/{id}', [ProductoController::class, 'show'])->name('admin.productos.show');

// --- 4. RUTAS DEL CARRITO Y COMERCIALIZACIÓN ---
Route::get('/comercializacion', [CarritoController::class, 'showCarrito'])->name('carrito.show');
Route::post('/carrito/agregar/{id}', [CarritoController::class, 'agregar'])->name('carrito.agregar');
Route::delete('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
Route::post('/carrito/confirmar', [CarritoController::class, 'confirmarCompra'])->name('carrito.confirmar');


// --- 5. PROCESAMIENTO DE CONTACTO (Sincronizado con base de datos) ---
Route::post('/contacto', [MensajeController::class, 'storePublic'])->name('contacto.enviar');

// --- 6. RUTAS DE ADMINISTRACIÓN PROTEGIDAS (SOLO ADMINS AUTENTICADOS) ---
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->group(function () {
    
    // Dashboard Principal de Métricas
    Route::get('/admin/dashboard', [UsuarioController::class, 'dashboard'])->name('admin.dashboard');
    
    // Gestión de Usuarios (ABM Completo con Creación Manual, Parches de ID y Roles)
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/crear', [UsuarioController::class, 'create'])->name('usuarios.create');
    Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
    Route::get('/usuarios/{id}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{usuario}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');
    
    // Gestión de Productos (ABM de paneles administrativos)
    Route::get('/admin/productos', [ProductoController::class, 'adminIndex'])->name('admin.productos.adminIndex');
    Route::get('/admin/productos/crear', [ProductoController::class, 'create'])->name('admin.productos.create');
    Route::post('/admin/productos', [ProductoController::class, 'store'])->name('admin.productos.store');
    Route::get('/admin/productos/{id}/editar', [ProductoController::class, 'edit'])->name('admin.productos.edit');
    Route::put('/admin/productos/{id}', [ProductoController::class, 'update'])->name('admin.productos.update');
    Route::delete('/admin/productos/{id}', [ProductoController::class, 'destroy'])->name('admin.productos.destroy');

    // ✅ GESTIÓN DE MENSAJES CORREGIDA (Llamadas reales al controlador sin duplicados)
    Route::get('/admin/mensajes', [MensajeController::class, 'index'])->name('admin.mensajes.index');
    Route::delete('/admin/mensajes/{id}', [MensajeController::class, 'destroy'])->name('admin.mensajes.destroy');

    // Roles
    Route::get('/roles', [RolController::class, 'index'])->name('roles.index');
});