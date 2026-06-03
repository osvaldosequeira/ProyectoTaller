<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creamos el administrador supremo cumpliendo tus reglas estrictas de contraseña
        User::create([
            'name'     => 'Osvaldo Admin',
            'email'    => 'admin.esencia@gmail.com', // Forzado a que cumpla con el filtro @gmail.com
            'password' => Hash::make('Retro2026!'),   // Mínimo 8 caracteres, incluye mayúscula y letras
            'es_admin' => 1,                          // Privilegio supremo activado
        ]);
    }
}