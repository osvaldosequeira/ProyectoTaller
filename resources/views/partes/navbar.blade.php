<nav class="navbar navbar-expand-lg navbar-dark"
     style="background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            z-index: 1050;">

    <div class="container">

        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('img/logo.png') }}"
                 alt="Esencia Retro Logo"
                 class="logo-navbar"
                 style="height: 50px; object-fit: contain;">
        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#menuEsencia"
                aria-controls="menuEsencia"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menuEsencia">

            <ul class="navbar-nav ms-auto text-center align-items-center"
                style="font-family: 'Playfair Display', serif;">

                <li class="nav-item">
                    <a class="nav-link text-uppercase small fw-bold text-white px-3"
                       href="{{ url('/') }}">
                        INICIO
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-uppercase small fw-bold text-white px-3"
                       href="{{ url('/quienes-somos') }}">
                        NOSOTROS
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-uppercase small fw-bold text-white px-3"
                       href="{{ url('/contacto') }}">
                        CONTACTO
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-uppercase small fw-bold text-white px-3"
                       href="{{ url('/terminos') }}">
                        TÉRMINOS
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-uppercase small fw-bold text-white px-3"
                       href="{{ url('/catalogo') }}">
                        CATALOGO
                    </a>
                </li>

                <li class="nav-item dropdown ms-lg-2">
                    <a class="nav-link dropdown-toggle text-white"
                       href="#"
                       id="usuarioDropdown"
                       role="button"
                       data-bs-toggle="dropdown"
                       aria-expanded="false"
                       style="display: inline-flex; align-items: center;">
                        
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
                    
                    <ul class="dropdown-menu dropdown-menu-end" style="background: rgba(30, 41, 59, 0.95); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.15); border-radius: 12px; margin-top: 10px;">
                        @auth
                            <li>
                                <span class="dropdown-item-text fw-bold text-warning small text-uppercase d-block py-2">
                                    👤 {{ Auth::user()->name }} 
                                    @if(Auth::user()->es_admin == 1)
                                        <span class="badge bg-danger ms-1" style="font-size: 0.65rem;">ADMIN</span>
                                    @endif
                                </span>
                            </li>
                            <li><hr class="dropdown-divider" style="border-color: rgba(255,255,255,0.15);"></li>
                            
                            @if(Auth::user()->es_admin == 1)
                                <li>
                                    <a class="dropdown-item text-white small fw-bold text-uppercase py-2" href="{{ url('/usuarios') }}">
                                        ⚙️ Panel Usuarios
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item text-white small fw-bold text-uppercase py-2" href="{{ url('/roles') }}">
                                        🛡️ Panel Roles
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider" style="border-color: rgba(255,255,255,0.15);"></li>
                            @endif

                            <li>
                                <form action="{{ url('/logout') }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger fw-bold text-start bg-transparent border-0 w-100 py-2">
                                        Cerrar Sesión
                                    </button>
                                </form>
                            </li>
                        @else
                            <li>
                                <a class="dropdown-item text-white py-2" href="{{ url('/login') }}">
                                    Iniciar Sesión
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item text-white py-2" href="{{ url('/registro') }}">
                                    Registrarse
                                </a>
                            </li>
                        @endauth
                    </ul>
                </li>

                <li class="nav-item ms-lg-3 my-2 my-lg-0">
                    <a class="nav-link position-relative text-white p-2 d-inline-block"
                       href="{{ url('/comercializacion') }}" title="Ver Carrito de Compras">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             width="20"
                             height="20"
                             fill="currentColor"
                             class="bi bi-cart3"
                             viewBox="0 0 16 16"
                             style="color: white; vertical-align: middle;">
                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a1 1 0 1 0 0 2 1 1 0 0 0 0-2m7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2"/>
                        </svg>

                        @if(session('carrito') && count(session('carrito')) > 0)
                            @php
                                $cantidadTotal = 0;
                                foreach(session('carrito') as $item) {
                                    $cantidadTotal += $item['cantidad'];
                                }
                            @endphp
                            <span class="position-absolute badge rounded-pill bg-danger text-white" 
                                  style="font-size: 0.7rem; padding: 0.35em 0.5em; top: 0px; right: -3px; z-index: 100; min-width: 18px; height: 18px; display: inline-flex; align-items: center; justify-content: center;">
                                {{ $cantidadTotal }}
                            </span>
                        @endif
                        
                        <span class="visually-hidden">Productos en el carrito</span>
                    </a>
                </li>

            </ul>

        </div>

    </div>
</nav>