@extends('plantilla')

@section('contenido')

<div class="container my-5">


<div class="CONTENEDOR-REGISTRO mx-auto text-white">

    <h2 class="TITULO-REGISTRO fw-bold text-center mb-4">

        REGISTRO DE USUARIO

    </h2>

    @if ($errors->any())

    <div class="ALERTA-REGISTRO alert alert-danger py-2 mb-4">

        <ul class="LISTA-ERRORES mb-0 small fw-bold">

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

    @endif

    <form method="POST"
          action="{{ url('/registro') }}">

        @csrf

        <div class="mb-3">

            <label class="LABEL-REGISTRO form-label small fw-bold text-uppercase">

                Nombre Completo

            </label>

            <input type="text"
                   name="nombre"
                   class="form-control INPUT-REGISTRO text-white"
                   value="{{ old('nombre') }}"
                   placeholder="Ingresá tu nombre completo"
                   required>

        </div>

        <div class="mb-3">

            <label class="LABEL-REGISTRO form-label small fw-bold text-uppercase">

                Correo Electrónico

            </label>

            <input type="email"
                   name="email"
                   class="form-control INPUT-REGISTRO text-white"
                   value="{{ old('email') }}"
                   placeholder="ejemplo@gmail.com"
                   required>

        </div>

        <div class="mb-4">

            <label class="LABEL-REGISTRO form-label small fw-bold text-uppercase">

                Contraseña

            </label>

            <input type="password"
                   name="password"
                   class="form-control INPUT-REGISTRO text-white"
                   placeholder="Ingresá una contraseña"
                   required>

            <div class="INFO-PASSWORD small mt-2">

                *Requisito: Debe contener al menos 8 caracteres, una letra mayúscula y letras minúsculas.

            </div>

        </div>

        <button type="submit"
                class="BTN-REGISTRO w-100 py-3 border-0 fw-bold text-uppercase">

            Registrarse

        </button>

    </form>

    <div class="text-center mt-4">

        <p class="TEXTO-LOGIN small mb-0">

            ¿Ya tenés una cuenta?

            <a href="{{ url('/login') }}"
               class="LINK-LOGIN text-decoration-none fw-bold">

                Iniciá sesión acá

            </a>

        </p>

    </div>

</div>


</div>

@endsection
