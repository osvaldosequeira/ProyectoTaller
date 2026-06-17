<!DOCTYPE html>
<html lang="es">
<head>

    <!-- Configuración de codificación de caracteres -->
    <meta charset="UTF-8">

    <!-- Permite que la página sea responsive en dispositivos móviles -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Título mostrado en la pestaña del navegador -->
    <title>Esencia Retro</title>

    <!-- Ícono mostrado en la pestaña del navegador -->
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">

    <!-- Hoja de estilos de Bootstrap almacenada localmente -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">

    <!-- Librería de iconos Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Hoja de estilos personalizada del proyecto -->
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">

</head>
<body>

    <!-- Inclusión de la barra de navegación -->
    @include('partes.navbar')

    <!-- Contenedor principal donde se renderiza el contenido de cada vista -->
    <main class="CUERPO-PRINCIPAL">

        @yield('contenido')

    </main>

    <!-- Inclusión del pie de página -->
    @include('partes.footer')

    <!-- Archivo JavaScript de Bootstrap -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script>

        // Variable que almacena la última posición registrada del scroll
        let lastScrollTop = 0;

        // Obtiene la referencia a la barra de navegación
        const navbar = document.querySelector('.navbar');

        // Evento que se ejecuta cada vez que el usuario desplaza la página
        window.addEventListener('scroll', function() {

            // Obtiene la posición actual del scroll vertical
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            // Si el usuario baja más de 100px y continúa desplazándose hacia abajo,
            // la barra de navegación se oculta agregando una clase CSS
            if (scrollTop > lastScrollTop && scrollTop > 100) {

                navbar.classList.add('NAVBAR-HIDDEN');

            } else {

                // Si el usuario desplaza hacia arriba,
                // la barra vuelve a mostrarse
                navbar.classList.remove('NAVBAR-HIDDEN');

            }

            // Actualiza la posición anterior del scroll
            lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;

        });

    </script>

</body>
</html>