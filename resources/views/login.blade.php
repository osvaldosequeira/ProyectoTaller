@extends('plantilla')

@section('contenido')

<div class="container my-5">

    <!-- Contenedor principal del formulario de inicio de sesión -->
    <div class="CONTENEDOR-LOGIN mx-auto text-white">

        <!-- Título principal -->
        <h2 class="TITULO-LOGIN fw-bold text-center mb-4">

            INICIAR SESIÓN

        </h2>

        <!-- Muestra los errores de validación o autenticación -->
        @if ($errors->any())

        <div class="ALERTA-LOGIN alert alert-danger py-2 mb-4">

            <ul class="LISTA-ERRORES mb-0 small fw-bold">

                <!-- Recorre y muestra todos los errores -->
                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

        @endif

        <!-- Formulario de inicio de sesión -->
        <form method="POST"
              action="{{ url('/login') }}">

            <!-- Token CSRF para protección contra ataques -->
            @csrf

            <!-- Campo de correo electrónico -->
            <div class="mb-3">

                <label class="LABEL-LOGIN form-label small fw-bold text-uppercase">

                    Correo Electrónico

                </label>

                <input type="email"
                       name="email"
                       class="form-control INPUT-LOGIN text-white"
                       value="{{ old('email') }}"
                       placeholder="ejemplo@gmail.com"
                       required>

            </div>

            <!-- Campo de contraseña -->
            <div class="mb-4">

                <label class="LABEL-LOGIN form-label small fw-bold text-uppercase">

                    Contraseña

                </label>

                <input type="password"
                       name="password"
                       class="form-control INPUT-LOGIN text-white"
                       placeholder="Ingresá tu contraseña"
                       required>

            </div>

            <!-- Botón para enviar el formulario -->
            <button type="submit"
                    class="BTN-LOGIN w-100 py-3 border-0 fw-bold text-uppercase">

                Ingresar

            </button>

        </form>

        <!-- Enlace para registrarse -->
        <div class="text-center mt-4">

            <p class="TEXTO-REGISTRO small mb-0">

                ¿No tenés cuenta?

                <a href="{{ url('/registro') }}"
                   class="LINK-REGISTRO text-decoration-none fw-bold">

                    Registrate acá

                </a>

            </p>

        </div>

    </div>

</div>

@endsection