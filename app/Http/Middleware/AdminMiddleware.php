<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Maneja una petición entrante. Only Admins.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Verificamos si el usuario inició sesión
        // 2. Verificamos si el campo 'es_admin' de la base de datos es igual a 1
        if (Auth::check() && Auth::user()->es_admin == 1) {
            return $next($request); // Permiso concedido, pasa al panel de control
        }

        // Si es un cliente común o no está logueado, lo rebotamos al catálogo con una alerta
        return redirect('/catalogo')->withErrors([
            'admin_error' => 'Acceso denegado. No tenés permisos comerciales de administrador para ingresar a esa sección.'
        ]);
    }
}