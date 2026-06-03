<!-- Barra de navegación con Glassmorphism corregida para Font Awesome 6 -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
    <div class="container">
        <!-- Logo de Esencia Retro -->
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('img/logo.png') }}" alt="Esencia Retro Logo" class="logo-navbar" style="height: 50px; object-fit: contain;">
        </a>

        <!-- Botón de Hamburguesa para Celulares -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuEsencia" aria-controls="menuEsencia" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Contenedor de links -->
        <div class="collapse navbar-collapse" id="menuEsencia">
            <ul class="navbar-nav ms-auto text-center align-items-center" style="font-family: 'Playfair Display', serif;">
                <li class="nav-item">
                    <a class="nav-link text-uppercase small fw-bold text-white px-3" href="{{ url('/') }}">INICIO</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase small fw-bold text-white px-3" href="{{ url('/quienes-somos') }}">NOSOTROS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase small fw-bold text-white px-3" href="{{ url('/contacto') }}">CONTACTO</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase small fw-bold text-white px-3" href="{{ url('/terminos') }}">TÉRMINOS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase small fw-bold text-white px-3" href="{{ url('/catalogo') }}">CATALOGO</a>
                </li>
                
                <!-- ICONO DE CARRITO CON CLASES DE FONT AWESOME 6 -->
                <li class="nav-item ms-lg-3 my-2 my-lg-0">
                    <a class="nav-link position-relative text-white" href="{{ route('carrito.show') }}">
                        <!-- Clase actualizada: fa-solid fa-cart-shopping -->
                        <!-- REEMPLAZÁ LA ETIQUETA <i> POR ESTE SVG COMPLETO -->
<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16" style="color: white; vertical-align: middle;">
    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a1 1 0 1 0 0 2 1 1 0 0 0 0-2m7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-7 1a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0m7 0a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0"/>
</svg>
                        
                        @if(session('carrito') && count(session('carrito')) > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.7rem; padding: 0.35em 0.5em;">
                                {{ count(session('carrito')) }}
                            </span>
                        @endif
                        <span class="d-lg-none ms-2 text-uppercase small fw-bold">COMERCIALIZACION</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>