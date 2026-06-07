@extends('plantilla')

@section('contenido')
<div class="container my-5 text-white">
    <div class="HEADER-PRINCIPAL mb-5">
        <h1 class="TITULO-CATALOGO mb-2">Catálogo de Productos</h1>
        <p class="SUBTITULO-CATALOGO text-center text-uppercase small opacity-75">Colecciones exclusivas y Mystery Boxes de colección</p>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4 CUERPO-PRINCIPAL">
        @forelse($productos as $producto)
            <div class="col">
                <div class="CARD-PRODUCTO">
                    <div class="IMG-CONTAINER text-center mb-3">
                        <img src="{{ asset('img/' . $producto->imagen) }}" 
                             class="IMG-PRODUCTO img-fluid" 
                             alt="{{ $producto->nombre }}"
                             onerror="this.onerror=null; this.src='{{ asset('img/caja_nacional.png') }}';"> 
                    </div>

                    <div class="CARD-CUERPO d-flex flex-column justify-content-between flex-grow-1">
                        <div class="mb-3">
                            <h3 class="TITULO-PRODUCTO text-uppercase fw-bold">{{ $producto->nombre }}</h3>
                            <p class="DESCRIPCION-PRODUCTO opacity-75 small">{{ $producto->descripcion }}</p>
                        </div>
                        
                        <div class="w-100 text-center">
                            <div class="PRECIO mb-3 mx-auto w-100 text-center">${{ number_format($producto->precio, 2, ',', '.') }}</div>
                            
                            <a href="{{ route('admin.productos.show', $producto->id) }}" class="BTN-COMPRAR fw-bold text-uppercase">
                                <span class="ICONO-BOTON me-2">⚙️</span> Configurar Caja
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="MENSAJE-VACIO fw-bold">No se encontraron Mystery Boxes disponibles en este momento.</p>
                <p class="SUBMENSAJE-VACIO small opacity-50">Asegurate de haber ejecutado las semillas con el comando php artisan db:seed o migrate:fresh --seed</p>
            </div>
        @endforelse
    </div>
</div>
@endsection