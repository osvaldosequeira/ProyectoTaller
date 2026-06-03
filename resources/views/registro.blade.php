@extends('plantilla')

@section('contenido')

<div class="container my-5">

    <div class="CONTENEDOR-INFO mx-auto" style="max-width: 600px;">

        <h2 class="fw-bold text-center mb-4">
            REGISTRO DE USUARIO
        </h2>

        <form method="POST" action="{{ url('/registro') }}">

            @csrf

            <div class="mb-3">

                <label class="form-label">
                    Nombre Completo
                </label>

                <input type="text"
                       name="nombre"
                       class="form-control"
                       placeholder="Ingresá tu nombre">

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Correo Electrónico
                </label>

                <input type="email"
                       name="email"
                       class="form-control"
                       placeholder="Ingresá tu email">

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Contraseña
                </label>

                <input type="password"
                       name="password"
                       class="form-control"
                       placeholder="Ingresá una contraseña">

            </div>

            <button type="submit"
                    class="BTN-COMPRAR w-100">

                Registrarse

            </button>

        </form>

    </div>

</div>

@endsection