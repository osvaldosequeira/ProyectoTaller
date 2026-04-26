#!/bin/bash
echo "--- Iniciando configuración de Esencia Retro (Linux/Mac) ---"

# 1. Instalar dependencias
echo "Instalando dependencias de Composer..."
composer install

# 2. Configurar archivo .env
if [ ! -f .env ]; then
    echo "Creando archivo .env..."
    cp .env.example .env
else
    echo "El archivo .env ya existe."
fi

# 3. Generar clave
echo "Generando clave de seguridad..."
php artisan key:generate

# 4. Base de datos SQLite
if [ ! -f database/database.sqlite ]; then
    echo "Creando base de datos SQLite..."
    touch database/database.sqlite
fi

# 5. Permisos y Migraciones
chmod -R 775 storage bootstrap/cache
php artisan migrate --force

echo "--- ¡Instalación Finalizada! ---"