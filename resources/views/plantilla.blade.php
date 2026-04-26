<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Esencia Retro</title>
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
 <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">

<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>
<body>

    @include('partes.navbar')
    @include('partes.header')

    <main class="CUERPO-PRINCIPAL">
        @yield('contenido')
    </main>

    @include('partes.footer')

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script>
        let lastScrollTop = 0;
        const navbar = document.querySelector('.navbar');

        window.addEventListener('scroll', function() {
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            // SI SCROLLEAS HACIA ABAJO Y PASASTE LOS 100PX, SE OCULTA
            if (scrollTop > lastScrollTop && scrollTop > 100) {
                navbar.classList.add('NAVBAR-HIDDEN');
            } else {
                // SI SCROLLEAS HACIA ARRIBA, APARECE
                navbar.classList.remove('NAVBAR-HIDDEN');
            }
            lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
        });
    </script>
</body>
</html>