@extends('plantilla')

@php
use Illuminate\Support\Str;
@endphp

@section('contenido')

<div class="CUERPO-PRINCIPAL container">

    <div class="HEADER-PRINCIPAL text-center my-4">
        <h1 class="TITULO-SECCION fw-bold text-uppercase">
            Catálogo de Productos
        </h1>
        <p class="text-muted text-uppercase small">
            Colecciones Exclusivas y Mystery Boxes
        </p>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4 my-3">

        @forelse($productos as $producto)

            <div class="col">
                <div class="CARD-PRODUCTO">

                    <div class="IMG-CONTAINER">
                        @if($producto->imagen)
                            <img src="{{ asset('img/' . $producto->imagen) }}" alt="{{ $producto->nombre }}">
                        @else
                            <img src="{{ asset('img/default-box.png') }}" alt="Imagen no disponible">
                        @endif
                    </div>

                    <div class="CARD-CUERPO">
                        <h4 class="fw-bold text-dark text-uppercase mb-2">
                            {{ $producto->nombre }}
                        </h4>

                        <p class="small text-muted text-justify px-2">
                            {{ Str::limit($producto->descripcion, 100, '...') }}
                        </p>

                        <p class="PRECIO">
                            ${{ number_format($producto->precio, 2, ',', '.') }}
                        </p>

                        <form action="{{ route('carrito.agregar', $producto->id) }}" method="POST">
    @csrf
    <button type="submit" class="BTN-COMPRAR w-100 border-0">
       Seleccionar Artículo
    </button>
</form>
                    </div>

                </div>
            </div>

        @empty

            <div class="col-12">
                <div class="CONTENEDOR-INFO text-center py-5">
                    <p class="mb-0 fw-bold text-muted">
                        No se encontraron productos disponibles en el catálogo de MariaDB en este momento.
                    </p>
                </div>
            </div>

        @endforelse

    </div>

</div>

@endsection