<!-- Barra de navegación principal del sitio -->
<nav class="navbar navbar-expand-lg">
    
    <!-- Contenedor que centra el contenido horizontalmente -->
    <div class="container justify-content-center">
        
        <!-- Lista de enlaces de navegación -->
        <ul class="navbar-nav">
            
            <!-- Enlace a la página de inicio -->
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}">INICIO</a>
            </li>
            
            <!-- Enlace a la página Quiénes somos -->
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/quienes-somos') }}">NOSOTROS</a>
            </li>
            
            <!-- Enlace a la página de contacto -->
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/contacto') }}">CONTACTO</a>
            </li>
            
            <!-- Enlace a los términos y condiciones -->
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/terminos') }}">TÉRMINOS</a>
            </li>
        
        </ul>
    </div>
</nav>