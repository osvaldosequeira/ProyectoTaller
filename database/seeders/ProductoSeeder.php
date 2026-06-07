<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Producto 1: Caja Nacional
        Producto::create([
            'nombre' => 'Mystery Box - Camisetas Nacionales',
            'precio' => 45000.00,
            'imagen' => 'caja_nacional.png',
            'descripcion' => 'Una selección única de indumentaria de clubes del fútbol argentino.'
        ]);

        // Producto 2: Caja Internacional
        Producto::create([
            'nombre' => 'Mystery Box - Joyas Internacionales',
            'precio' => 68000.00,
            'imagen' => 'caja_internacional.png',
            'descripcion' => 'Prendas históricas de los clubes más grandes de Europa y el mundo.'
        ]);

        // Producto 3: Caja de la Selección
        Producto::create([
            'nombre' => 'Mystery Box - Selección Argentina',
            'precio' => 56000.00,
            'imagen' => 'caja_seleccion.png',
            'descripcion' => 'Casacas y prendas oficiales que marcaron la historia de nuestra selección.'
        ]);
    }
}