<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Esencia Retro</title>
    
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
    
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>
<body>

    @include('partes.navbar')
    
    <main class="CUERPO-PRINCIPAL">
        @yield('contenido')
    </main>

    @include('partes.footer')

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