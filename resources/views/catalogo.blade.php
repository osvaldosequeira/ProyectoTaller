@extends('plantilla')

@section('contenido')
<div class="container my-5 text-white">

    <!-- Encabezado principal de la página -->
    <div class="HEADER-PRINCIPAL mb-5">

        <!-- Título principal del catálogo -->
        <h1 class="TITULO-CATALOGO mb-2">
            Catálogo de Productos
        </h1>

        <!-- Subtítulo descriptivo -->
        <p class="SUBTITULO-CATALOGO text-center text-uppercase small opacity-75">
            Colecciones exclusivas y Mystery Boxes de colección
        </p>
    </div>

    <!-- Contenedor de tarjetas de productos -->
    <div class="row row-cols-1 row-cols-md-3 g-4 CUERPO-PRINCIPAL">

        <!-- Recorre todos los productos recibidos desde el controlador -->
        @forelse($productos as $producto)

            <div class="col">

                <!-- Tarjeta individual de producto -->
                <div class="CARD-PRODUCTO">

                    <!-- Contenedor de la imagen -->
                    <div class="IMG-CONTAINER text-center mb-3">

                        <img src="{{ asset('img/' . $producto->imagen) }}"
     class="IMG-PRODUCTO img-fluid"
     alt="{{ $producto->nombre }}"
     onerror="this.onerror=null; this.src='{{ asset('img/caja_nacional.png') }}';">
                    </div>

                    <!-- Cuerpo de la tarjeta -->
                    <div class="CARD-CUERPO d-flex flex-column justify-content-between flex-grow-1">

                        <!-- Información principal del producto -->
                        <div class="mb-3">

                            <!-- Nombre del producto -->
                            <h3 class="TITULO-PRODUCTO text-uppercase fw-bold">
                                {{ $producto->nombre }}
                            </h3>

                            <!-- Descripción del producto -->
                            <p class="DESCRIPCION-PRODUCTO opacity-75 small">
                                {{ $producto->descripcion }}
                            </p>
                        </div>

                        <!-- Precio y botón de acción -->
                        <div class="w-100 text-center">

                            <!-- Precio formateado -->
                            <div class="PRECIO mb-3 mx-auto w-100 text-center">
                                ${{ number_format($producto->precio, 2, ',', '.') }}
                            </div>

                            <!-- Botón para configurar la caja o ver detalles -->
                            <a href="{{ route('admin.productos.show', $producto->id) }}"
                               class="BTN-COMPRAR fw-bold text-uppercase">

                                <span class="ICONO-BOTON me-2">⚙️</span>
                                Configurar Caja
                            </a>

                        </div>
                    </div>
                </div>
            </div>

        <!-- Se ejecuta cuando no existen productos -->
        @empty

            <div class="col-12 text-center py-5">

                <!-- Mensaje principal -->
                <p class="MENSAJE-VACIO fw-bold">
                    No se encontraron Mystery Boxes disponibles en este momento.
                </p>

                <!-- Mensaje de ayuda para desarrollo o carga de datos -->
                <p class="SUBMENSAJE-VACIO small opacity-50">
                    Asegurate de haber ejecutado las semillas con el comando
                    php artisan db:seed o migrate:fresh --seed
                </p>

            </div>

        @endforelse

    </div>
</div>
@endsection