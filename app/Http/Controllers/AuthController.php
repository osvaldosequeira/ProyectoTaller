<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    // REGISTRO
    public function registro(Request $request)
    {

        User::create([

            'name' => $request->nombre,

            'email' => $request->email,

            'password' => Hash::make($request->password)

        ]);

        return redirect('/login');
    }

    // LOGIN
    public function login(Request $request)
    {

        $credenciales = [

            'email' => $request->email,

            'password' => $request->password

        ];

        if (Auth::attempt($credenciales)) {

            $request->session()->regenerate();

            return redirect('/');
        }

        return back()->with('error', 'Datos incorrectos');
    }

    // LOGOUT
    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}