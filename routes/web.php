<?php

// Importa la clase Route para definir las rutas de la aplicación
use Illuminate\Support\Facades\Route;

// Permite manejar solicitudes HTTP directamente en rutas si fuera necesario
use Illuminate\Http\Request;

// Importación de controladores utilizados por las rutas
use App\Http\Controllers\VentaController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MensajeController;

/*
|--------------------------------------------------------------------------
| RUTAS DE LA APLICACIÓN - ESENCIA RETRO
|--------------------------------------------------------------------------
| Aquí se definen todas las rutas públicas, privadas y administrativas
| del sistema.
|--------------------------------------------------------------------------
*/

// --- 1. RUTAS PÚBLICAS (ACCESO GLOBAL) ---

// Página principal
Route::get('/', function () {
    return view('principal');
})->name('home');

// Página "Quiénes Somos"
Route::get('/quienes-somos', function () {
    return view('quienes-somos');
})->name('quienes-somos');

// Página de términos y condiciones
Route::get('/terminos', function () {
    return view('terminos');
})->name('terminos');

// Página de contacto
Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');


// --- 2. AUTENTICACIÓN ---

// Formulario de inicio de sesión
Route::get('/login', function () {
    return view('login');
})->name('login');

// Formulario de registro
Route::get('/registro', function () {
    return view('registro');
})->name('registro');

// Procesa el inicio de sesión
Route::post('/login', [AuthController::class, 'login']);

// Procesa el registro de usuarios
Route::post('/registro', [AuthController::class, 'registro']);

// Cierra la sesión del usuario autenticado
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


// --- 3. CATÁLOGO PÚBLICO ---

// Lista pública de productos
Route::get('/catalogo', [ProductoController::class, 'index'])
    ->name('admin.productos.index');

// Detalle de un producto específico
Route::get('/catalogo/{id}', [ProductoController::class, 'show'])
    ->name('admin.productos.show');


// --- 4. CARRITO Y COMPRAS (SOLO USUARIOS LOGUEADOS) ---

Route::middleware(['auth'])->group(function () {

    // Muestra el carrito actual del usuario
    Route::get('/comercializacion', [CarritoController::class, 'showCarrito'])
        ->name('carrito.show');

    // Agrega un producto al carrito
    Route::post('/carrito/agregar/{id}', [CarritoController::class, 'agregar'])
        ->name('carrito.agregar');

    // Elimina un producto del carrito
    Route::delete('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar'])
        ->name('carrito.eliminar');

    // Confirma la compra y genera la venta
    Route::post('/carrito/confirmar', [CarritoController::class, 'confirmarCompra'])
        ->name('carrito.confirmar');

});


// --- 5. CONTACTO ---

// Envía mensajes desde el formulario de contacto público
Route::post('/contacto', [MensajeController::class, 'storePublic'])
    ->name('contacto.enviar');


// --- 6. ADMINISTRACIÓN (SOLO ADMINS) ---

Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->group(function () {

    // ==========================
    // DASHBOARD ADMINISTRATIVO
    // ==========================

    Route::get('/admin/dashboard', [UsuarioController::class, 'dashboard'])
        ->name('admin.dashboard');


    // ==========================
    // GESTIÓN DE USUARIOS
    // ==========================

    // Lista de usuarios
    Route::get('/usuarios', [UsuarioController::class, 'index'])
        ->name('usuarios.index');

    // Formulario para crear usuario
    Route::get('/usuarios/crear', [UsuarioController::class, 'create'])
        ->name('usuarios.create');

    // Guarda un nuevo usuario
    Route::post('/usuarios', [UsuarioController::class, 'store'])
        ->name('usuarios.store');

    // Formulario de edición
    Route::get('/usuarios/{id}/edit', [UsuarioController::class, 'edit'])
        ->name('usuarios.edit');

    // Actualiza datos del usuario
    Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])
        ->name('usuarios.update');

    // Elimina un usuario
    Route::delete('/usuarios/{usuario}', [UsuarioController::class, 'destroy'])
        ->name('usuarios.destroy');


    // ==========================
    // GESTIÓN DE PRODUCTOS
    // ==========================

    // Lista administrativa de productos
    Route::get('/admin/productos', [ProductoController::class, 'adminIndex'])
        ->name('admin.productos.adminIndex');

    // Formulario para crear producto
    Route::get('/admin/productos/crear', [ProductoController::class, 'create'])
        ->name('admin.productos.create');

    // Guarda un nuevo producto
    Route::post('/admin/productos', [ProductoController::class, 'store'])
        ->name('admin.productos.store');

    // Formulario de edición
    Route::get('/admin/productos/{id}/editar', [ProductoController::class, 'edit'])
        ->name('admin.productos.edit');

    // Actualiza un producto existente
    Route::put('/admin/productos/{id}', [ProductoController::class, 'update'])
        ->name('admin.productos.update');

    // Elimina un producto
    Route::delete('/admin/productos/{id}', [ProductoController::class, 'destroy'])
        ->name('admin.productos.destroy');


    // ==========================
    // GESTIÓN DE MENSAJES
    // ==========================

    // Lista de mensajes recibidos
    Route::get('/admin/mensajes', [MensajeController::class, 'index'])
        ->name('admin.mensajes.index');

    // Elimina un mensaje
    Route::delete('/admin/mensajes/{id}', [MensajeController::class, 'destroy'])
        ->name('admin.mensajes.destroy');


    // ==========================
    // GESTIÓN DE ROLES
    // ==========================

    // Lista de roles disponibles
    Route::get('/roles', [RolController::class, 'index'])
        ->name('roles.index');


    // ==========================
    // GESTIÓN DE VENTAS
    // ==========================

    // Lista de ventas registradas
    Route::get(
        '/admin/ventas',
        [VentaController::class, 'adminVentas']
    )->name('admin.ventas.index');

    // Detalle de una venta específica
    Route::get(
        '/admin/ventas/{id}',
        [VentaController::class, 'adminDetalle']
    )->name('admin.ventas.detalle');

});


// --- 7. COMPRAS DEL USUARIO ---

// Muestra el historial de compras del usuario
Route::get(
    '/mis-compras',
    [VentaController::class, 'misCompras']
)->name('mis-compras');

// Muestra el detalle de una compra específica
Route::get(
    '/mis-compras/{id}',
    [VentaController::class, 'detalle']
)->name('detalle-compra');