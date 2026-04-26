@echo off
echo --- Iniciando configuracion de Esencia Retro (Windows) ---

:: 1. Instalar dependencias de PHP
echo Instalando dependencias de Composer...
call composer install

:: 2. Configurar archivo de entorno
if not exist .env (
    echo Creando archivo .env desde la plantilla...
    copy .env.example .env
) else (
    echo El archivo .env ya existe.
)

:: 3. Generar clave de aplicacion
echo Generando clave de seguridad de Laravel...
php artisan key:generate

:: 4. Crear base de datos SQLite si no existe
if not exist database\database.sqlite (
    echo Creando base de datos SQLite...
    type nul > database\database.sqlite
)

:: 5. Ejecutar migraciones
echo Ejecutando migraciones...
php artisan migrate --force

echo --- Instalacion Finalizada con exito! ---
pause