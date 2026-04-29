<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Define la codificación de caracteres -->
    <meta charset="UTF-8">
    
    <!-- Permite que la página sea responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

   
    <title>Esencia Retro</title>
    
    <!-- Ícono de la pestaña -->
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
    
    <!-- Archivo CSS de Bootstrap -->
 <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">

    <!-- Estilos personalizados del proyecto -->
<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>
<body>

    <!-- Inclusión de la barra de navegación -->
    @include('partes.navbar')
    
    <!-- Inclusión del header -->
    @include('partes.header')

    <!-- Contenido dinámico de cada vista -->
    <main class="CUERPO-PRINCIPAL">
        @yield('contenido')
    </main>

    <!-- Inclusión del footer -->
    @include('partes.footer')

    <!-- Script de Bootstrap -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script>
        // Variable que guarda la posición anterior del scroll
        let lastScrollTop = 0;
        
        // Selecciona la barra de navegación
        const navbar = document.querySelector('.navbar');

        // Evento que se ejecuta al hacer scroll
        window.addEventListener('scroll', function() {
            
            // Obtiene la posición actual del scroll
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            // Si se hace scroll hacia abajo y pasa los 100px, se oculta la navbar
            if (scrollTop > lastScrollTop && scrollTop > 100) {
                navbar.classList.add('NAVBAR-HIDDEN');
            } else {
                // Si se hace scroll hacia arriba, la navbar vuelve a mostrarse
                navbar.classList.remove('NAVBAR-HIDDEN');
            }
            
            // Actualiza la posición del scroll
            lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
        });
    </script>
</body>
</html>