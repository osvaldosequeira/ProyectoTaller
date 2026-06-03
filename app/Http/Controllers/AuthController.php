<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // PROCESAR REGISTRO CON FILTROS ESTRICTOS
    public function registro(Request $request)
    {
        // Reglas de validación avanzadas solicitadas
        $request->validate([
            'nombre'   => 'required|string|max:255',
            // Valida estructura de email tradicional + que termine estrictamente en @gmail.com
            'email'    => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email',
                'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/i'
            ],
            // min:8 (8 dígitos/caracteres) | regex para al menos una mayúscula (?=.*[A-Z]) y letras (?=.*[a-z])
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z]).+$/'
            ],
        ], [
            'email.regex'    => 'El registro comercial está limitado exclusivamente a cuentas válidas de @gmail.com.',
            'email.unique'   => 'Este correo electrónico ya se encuentra registrado.',
            'password.min'   => 'La contraseña debe contener un tamaño mínimo de 8 caracteres.',
            'password.regex' => 'La contraseña es inválida. Debe incluir al menos una letra mayúscula y letras minúsculas.',
        ]);

        // Creación del usuario en MariaDB usando Laravel 11 Attributes
        $user = User::create([
            'name'     => $request->nombre,
            'email'    => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // Login automático de cortesía comercial
        Auth::login($user);

        return redirect('/catalogo')->with('exito', '¡Cuenta comercial creada! Bienvenido a Esencia Retro.');
    }

    // LOGIN
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $credenciales = [
            'email'    => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($credenciales)) {
            // ⚠️ Esto limpia cualquier sesión vieja y fuerza la nueva cookie en tu navegador
            $request->session()->regenerate();

            return redirect()->intended('/catalogo')->with('exito', '¡Bienvenido de vuelta!');
        }

        return back()->withErrors([
            'email' => 'Datos incorrectos.',
        ])->onlyInput('email');
    }

    // CERRAR SESIÓN
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('exito', 'Sesión finalizada.');
    }
}