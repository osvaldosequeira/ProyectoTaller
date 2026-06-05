<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Forzamos a que se ejecuten los dos sembradores de corrido
        $this->call([
            AdminUserSeeder::class,
            ProductoSeeder::class,
        ]);
    }
}