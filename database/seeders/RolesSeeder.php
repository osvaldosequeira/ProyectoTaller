<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rol;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'nombre' => 'admin',
                'descripcion' => 'Administrador del sistema'
            ],
            [
                'nombre' => 'cliente',
                'descripcion' => 'Cliente del ecommerce'
            ],
        ];

        foreach ($roles as $rol) {
            Rol::firstOrCreate(
                ['nombre' => $rol['nombre']],
                $rol
            );
        }
    }
}