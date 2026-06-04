@extends('plantilla')

@section('contenido')

<div class="container my-5">


<div class="CONTENEDOR-LOGIN mx-auto text-white">

    <h2 class="TITULO-LOGIN fw-bold text-center mb-4">

        INICIAR SESIÓN

    </h2>

    @if ($errors->any())

    <div class="ALERTA-LOGIN alert alert-danger py-2 mb-4">

        <ul class="LISTA-ERRORES mb-0 small fw-bold">

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

    @endif

    <form method="POST"
          action="{{ url('/login') }}">

        @csrf

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

        <button type="submit"
                class="BTN-LOGIN w-100 py-3 border-0 fw-bold text-uppercase">

            Ingresar

        </button>

    </form>

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
