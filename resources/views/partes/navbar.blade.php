<!-- NAVBAR ESENCIA RETRO -->
<nav class="navbar navbar-expand-lg navbar-dark NAVBAR-ESENCIA">

    <div class="container">

        <!-- LOGO -->
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('img/logo.png') }}"
                 alt="Esencia Retro Logo"
                 class="LOGO-NAVBAR">
        </a>

        <!-- BOTÓN HAMBURGUESA -->
        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#menuEsencia">

            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- MENÚ -->
        <div class="collapse navbar-collapse" id="menuEsencia">

            <ul class="navbar-nav ms-auto text-center align-items-center FUENTE-NAVBAR">

                <li class="nav-item">
                    <a class="nav-link NAV-LINK-ESENCIA"
                       href="{{ url('/') }}">
                        Inicio
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link NAV-LINK-ESENCIA"
                       href="{{ url('/quienes-somos') }}">
                        Nosotros
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link NAV-LINK-ESENCIA"
                       href="{{ url('/catalogo') }}">
                        Catálogo
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link NAV-LINK-ESENCIA"
                       href="{{ url('/contacto') }}">
                        Contacto
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link NAV-LINK-ESENCIA"
                       href="{{ url('/terminos') }}">
                        Términos
                    </a>
                </li>

                <!-- MENÚ USUARIO -->
                <li class="nav-item dropdown ms-lg-2">

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

                    <ul class="dropdown-menu dropdown-menu-end shadow">

                        @auth

                        <li>
                            <span class="dropdown-item-text MENU-USUARIO-NOMBRE">
                                👋 {{ Auth::user()->name }}
                            </span>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        @if(Auth::user()->es_admin == 1)

                        <li>
                            <a class="dropdown-item MENU-USUARIO-ITEM"
                               href="{{ route('admin.dashboard') }}">
                                📊 Dashboard
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item MENU-USUARIO-ITEM"
                               href="{{ route('admin.productos.index') }}">
                                📦 Gestión Productos
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item MENU-USUARIO-ITEM"
                               href="{{ route('usuarios.index') }}">
                                👥 Usuarios
                            </a>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        @endif

                        <li>
                            <form action="{{ url('/logout') }}" method="POST">
                                @csrf

                                <button type="submit"
                                        class="dropdown-item MENU-USUARIO-ITEM BTN-CERRAR-SESION">

                                    🚪 Cerrar Sesión

                                </button>
                            </form>
                        </li>

                        @else

                        <li>
                            <a class="dropdown-item MENU-USUARIO-ITEM"
                               href="{{ url('/login') }}">
                                🔑 Iniciar Sesión
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item MENU-USUARIO-ITEM"
                               href="{{ url('/registro') }}">
                                📝 Registrarse
                            </a>
                        </li>

                        @endauth

                    </ul>

                </li>

                <!-- CARRITO -->
                <li class="nav-item ms-lg-3">

                    <a class="nav-link position-relative ICONO-CARRITO"
                       href="{{ url('/comercializacion') }}">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             width="20"
                             height="20"
                             fill="currentColor"
                             class="bi bi-cart3"
                             viewBox="0 0 16 16">

                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5"/>
                        </svg>

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