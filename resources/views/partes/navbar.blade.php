<nav class="navbar navbar-expand-lg navbar-dark NAVBAR-ESENCIA">

    <!-- Contenedor principal del navbar -->
    <div class="container">

        <!-- Logo principal que redirige al inicio -->
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('img/logo.png') }}"
                 alt="Esencia Retro Logo"
                 class="LOGO-NAVBAR">
        </a>

        <!-- Botón hamburguesa para dispositivos móviles -->
        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#menuEsencia">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menú colapsable -->
        <div class="collapse navbar-collapse" id="menuEsencia">

            <!-- Menú principal de navegación -->
            <ul class="navbar-nav ms-auto text-center align-items-center FUENTE-NAVBAR">

                <!-- Enlace al inicio -->
                <li class="nav-item">
                    <a class="nav-link NAV-LINK-ESENCIA" href="{{ url('/') }}">Inicio</a>
                </li>

                <!-- Enlace a la sección Nosotros -->
                <li class="nav-item">
                    <a class="nav-link NAV-LINK-ESENCIA" href="{{ url('/quienes-somos') }}">Nosotros</a>
                </li>

                <!-- Enlace al catálogo de productos -->
                <li class="nav-item">
                    <a class="nav-link NAV-LINK-ESENCIA" href="{{ url('/catalogo') }}">Catálogo</a>
                </li>

                <!-- Enlace al formulario de contacto -->
                <li class="nav-item">
                    <a class="nav-link NAV-LINK-ESENCIA" href="{{ url('/contacto') }}">Contacto</a>
                </li>

                <!-- Enlace a términos y condiciones -->
                <li class="nav-item">
                    <a class="nav-link NAV-LINK-ESENCIA" href="{{ url('/terminos') }}">Términos</a>
                </li>

                <!-- Opciones exclusivas para administradores -->
                @auth
                    @if(Auth::user()->es_admin == 1)
                    <li class="nav-item dropdown">

                        <!-- Menú desplegable del panel administrativo -->
                        <a class="nav-link dropdown-toggle NAV-LINK-ESENCIA fw-bold text-warning"
                           href="#"
                           id="adminDropdown"
                           role="button"
                           data-bs-toggle="dropdown"
                           aria-expanded="false">
                            ⚙️ Panel Admin
                        </a>

                        <ul class="dropdown-menu dropdown-menu-dark shadow" aria-labelledby="adminDropdown">

                            <!-- Dashboard administrativo -->
                            <li>
                                <a class="dropdown-item MENU-USUARIO-ITEM" href="{{ route('admin.dashboard') }}">
                                    📊 Dashboard
                                </a>
                            </li>

                            <!-- Gestión de productos -->
                            <li>
                                <a class="dropdown-item MENU-USUARIO-ITEM" href="{{ route('admin.productos.adminIndex') }}">
                                    📦 Gestión Productos
                                </a>
                            </li>

                            <!-- Gestión de usuarios -->
                            <li>
                                <a class="dropdown-item MENU-USUARIO-ITEM" href="{{ route('usuarios.index') }}">
                                    👥 Gestión de Usuarios
                                </a>
                            </li>

                            <!-- Gestión de ventas -->
                            <li>
                                <a class="dropdown-item MENU-USUARIO-ITEM" href="{{ route('admin.ventas.index') }}">
                                    💰 Gestión de Ventas
                                </a>
                            </li>

                            <!-- Gestión de mensajes recibidos -->
                            <li>
                                <a class="dropdown-item MENU-USUARIO-ITEM" href="{{ route('admin.mensajes.index') }}">
                                    ✉️ Gestión de Mensajes
                                </a>
                            </li>

                        </ul>
                    </li>
                    @endif
                @endauth

                <!-- Menú desplegable del usuario -->
                <li class="nav-item dropdown ms-lg-2">

                    <!-- Ícono de usuario -->
                    <a class="nav-link dropdown-toggle ICONO-USUARIO"
                       href="#"
                       id="usuarioDropdown"
                       data-bs-toggle="dropdown">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             width="22"
                             height="22"
                             fill="currentColor"
                             class="bi bi-person-circle"
                             viewBox="0 0 16 16">
                            <path d="M11 10a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                            <path fill-rule="evenodd"
                                  d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                        </svg>
                    </a>

                    <!-- Menú desplegable del usuario -->
                    <ul class="dropdown-menu dropdown-menu-end shadow">

                        @auth

                        <!-- Nombre del usuario autenticado -->
                        <li>
                            <span class="dropdown-item-text MENU-USUARIO-NOMBRE">
                                👋 {{ Auth::user()->name }}
                            </span>
                        </li>

                        <!-- Acceso al historial de compras -->
                        <li>
                            <a class="dropdown-item MENU-USUARIO-ITEM"
                               href="{{ route('mis-compras') }}">
                                🛍 Mis Compras
                            </a>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <!-- Cierre de sesión -->
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item MENU-USUARIO-ITEM BTN-CERRAR-SESION">
                                    🚪 Cerrar Sesión
                                </button>
                            </form>
                        </li>

                        @else

                        <!-- Inicio de sesión -->
                        <li>
                            <a class="dropdown-item MENU-USUARIO-ITEM" href="{{ url('/login') }}">
                                🔑 Iniciar Sesión
                            </a>
                        </li>

                        <!-- Registro de usuario -->
                        <li>
                            <a class="dropdown-item MENU-USUARIO-ITEM" href="{{ url('/registro') }}">
                                📝 Registrarse
                            </a>
                        </li>

                        @endauth

                    </ul>

                </li>

                <!-- Ícono del carrito de compras -->
                <li class="nav-item ms-lg-3">
                    <a class="nav-link position-relative ICONO-CARRITO" href="{{ url('/comercializacion') }}">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             width="20"
                             height="20"
                             fill="currentColor"
                             class="bi bi-cart3"
                             viewBox="0 0 16 16">
                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5"/>
                        </svg>

                        <!-- Muestra la cantidad total de productos en el carrito -->
                        @if(session('carrito') && count(session('carrito')) > 0)
                        <span class="badge rounded-pill bg-danger BADGE-CARRITO">
                            {{ collect(session('carrito'))->sum('cantidad') }}
                        </span>
                        @endif

                    </a>
                </li>

            </ul>

        </div>

    </div>

</nav>