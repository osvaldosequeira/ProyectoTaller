<?php

// Importa la clase Inspiring que contiene frases motivacionales predefinidas
use Illuminate\Foundation\Inspiring;

// Importa la fachada Artisan para registrar comandos personalizados
use Illuminate\Support\Facades\Artisan;

// Define un comando personalizado llamado "inspire"
Artisan::command('inspire', function () {

    // Muestra en consola una frase inspiradora aleatoria
    $this->comment(Inspiring::quote());

})

// Descripción del comando que aparece al ejecutar "php artisan list"
->purpose('Display an inspiring quote');