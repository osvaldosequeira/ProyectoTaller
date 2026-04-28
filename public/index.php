<?php

// Importa las clases necesarias de Laravel
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

// Define una constante que guarda el tiempo en que inicia la app
define('LARAVEL_START', microtime(true));

// Verifica si la aplicación está en modo mantenimiento
// Si existe ese archivo, lo carga (muestra página de mantenimiento)
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Carga el autoloader de Composer
// Esto permite que Laravel cargue automáticamente las clases
require __DIR__.'/../vendor/autoload.php';

// Inicia (bootstrap) la aplicación Laravel
// Carga toda la configuración base del framework
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

// Captura la solicitud HTTP (lo que pide el usuario desde el navegador)
// y la procesa dentro de la aplicación
$app->handleRequest(Request::capture());