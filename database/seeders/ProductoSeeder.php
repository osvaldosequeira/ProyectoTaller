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
        // Caja Mundial

        Producto::create([

            'nombre' => 'Mystery Box - Edición Mundial',

            'precio' => 55000.00,

            'stock' => 20,

            'imagen' => 'caja_mundial.png',

            'descripcion' => 'Descubrí camisetas históricas de selecciones que hicieron historia en los mundiales.'

        ]);

        // Caja Champions

        Producto::create([

            'nombre' => 'Mystery Box - Champions League',

            'precio' => 65000.00,

            'stock' => 15,

            'imagen' => 'caja_champions.png',

            'descripcion' => 'Remeras icónicas de clubes europeos protagonistas de noches inolvidables.'

        ]);

        // Caja Libertadores

        Producto::create([

            'nombre' => 'Mystery Box - Libertadores',

            'precio' => 50000.00,

            'stock' => 10,

            'imagen' => 'caja_libertadores.png',

            'descripcion' => 'Camisetas legendarias de equipos sudamericanos que marcaron época.'

        ]);
    }
}