@extends('plantilla')

@php
use Illuminate\Support\Str;
@endphp

@section('contenido')

<div class="CUERPO-PRINCIPAL container my-5">


<div class="HEADER-PRINCIPAL text-center my-4">

    <h1 class="TITULO-SECCION fw-bold text-uppercase TITULO-CATALOGO">
        Catálogo de Productos
    </h1>

    <p class="SUBTITULO-CATALOGO text-muted text-uppercase small">
        Colecciones Exclusivas y Mystery Boxes de Colección
    </p>

</div>

<div class="row row-cols-1 row-cols-md-3 g-4 my-3 justify-content-center">

    @forelse($productos as $producto)

    <div class="col">

        <div class="CARD-PRODUCTO">

            <div class="IMG-CONTAINER text-center p-3">

                @if($producto->imagen)

                <img src="{{ asset('img/' . $producto->imagen) }}"
                     alt="{{ $producto->nombre }}"
                     class="IMG-PRODUCTO img-fluid">

                @else

                <img src="{{ asset('img/default-box.png') }}"
                     alt="Imagen no disponible"
                     class="IMG-PRODUCTO img-fluid">

                @endif

            </div>

            <div class="CARD-CUERPO p-4 text-center text-white">

                <h4 class="TITULO-PRODUCTO fw-bold text-uppercase mb-2">

                    {{ $producto->nombre }}

                </h4>

                <p class="DESCRIPCION-PRODUCTO small opacity-75 px-2 mb-3">

                    {{ Str::limit($producto->descripcion,95,'...') }}

                </p>

                <p class="PRECIO fw-bold text-success fs-4 mb-4">

                    ${{ number_format($producto->precio,2,',','.') }}

                </p>

                <a href="{{ route('producto.show', $producto->id) }}"
                   class="BTN-COMPRAR text-decoration-none d-block text-center py-2 fw-bold text-uppercase">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         width="16"
                         height="16"
                         fill="currentColor"
                         class="bi bi-sliders me-2 ICONO-BOTON"
                         viewBox="0 0 16 16">

                        <path fill-rule="evenodd"
                        d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3"/>

                    </svg>

                    Configurar Caja

                </a>

            </div>

        </div>

    </div>

    @empty

    <div class="col-12">

        <div class="CONTENEDOR-INFO text-center py-5">

            <svg xmlns="http://www.w3.org/2000/svg"
                 width="40"
                 height="40"
                 fill="currentColor"
                 class="bi bi-database-exclamation text-warning mb-3"
                 viewBox="0 0 16 16">

            </svg>

            <p class="MENSAJE-VACIO mb-0 fw-bold">

                No se encontraron productos indexados en la tabla central de MariaDB en este momento.

            </p>

            <small class="SUBMENSAJE-VACIO d-block mt-2">

                Por favor, ejecute migraciones o cargue Mystery Boxes iniciales.

            </small>

        </div>

    </div>

    @endforelse

</div>


</div>

@endsection
