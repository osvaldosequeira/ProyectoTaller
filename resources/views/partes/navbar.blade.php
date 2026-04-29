<!-- Barra de navegación principal con Glassmorphism -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <!-- Logo de la marca -->
<a class="navbar-brand" href="{{ url('/') }}">
    <img src="{{ asset('img/logo.png') }}" alt="Esencia Retro Logo" class="logo-navbar">
</a>

        <!-- Botón de Hamburguesa (Solo se ve en celulares) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuEsencia" aria-controls="menuEsencia" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Contenedor de los links que se colapsan -->
        <div class="collapse navbar-collapse" id="menuEsencia">
            <ul class="navbar-nav ms-auto text-center">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">INICIO</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/quienes-somos') }}">NOSOTROS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/contacto') }}">CONTACTO</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/terminos') }}">TÉRMINOS</a>
                </li>
            </ul>
        </div>
    </div>
</nav>