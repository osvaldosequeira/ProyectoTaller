@extends('plantilla')

@php
use Illuminate\Support\Str;
@endphp

@section('contenido')

<div class="CUERPO-PRINCIPAL container my-5">

    <div class="HEADER-PRINCIPAL text-center my-4">
        <h1 class="TITULO-SECCION fw-bold text-uppercase" style="font-family: 'Playfair Display', serif;">
            Catálogo de Productos
        </h1>
        <p class="text-muted text-uppercase small tracking-wider">
            Colecciones Exclusivas y Mystery Boxes de Colección
        </p>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4 my-3 justify-content-center">

        @forelse($productos as $producto)

            <div class="col">
                <div class="CARD-PRODUCTO" style="background: rgba(30, 41, 59, 0.5); backdrop-filter: blur(10px); border-radius: 20px; border: 1px solid rgba(255, 255, 255, 0.1); height: 100%; display: flex; flex-column: justify-content-between; transition: transform 0.3s ease; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
                    
                    <div class="IMG-CONTAINER text-center p-3">
                        @if($producto->imagen)
                            <img src="{{ asset('img/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="img-fluid" style="max-height: 240px; object-fit: contain; border-radius: 15px;">
                        @else
                            <img src="{{ asset('img/default-box.png') }}" alt="Imagen no disponible" class="img-fluid" style="max-height: 240px; object-fit: contain; border-radius: 15px;">
                        @endif
                    </div>

                    <div class="CARD-CUERPO p-4 text-center text-white">
                        <h4 class="fw-bold text-uppercase mb-2" style="font-family: 'Playfair Display', serif; font-size: 1.15rem; min-height: 55px;">
                            {{ $producto->nombre }}
                        </h4>

                        <p class="small opacity-75 text-justify px-2 mb-3" style="min-height: 65px;">
                            {{ Str::limit($producto->descripcion, 95, '...') }}
                        </p>

                        <p class="PRECIO fw-bold text-success fs-4 mb-4">
                            ${{ number_format($producto->precio, 2, ',', '.') }}
                        </p>

                        <a href="{{ route('producto.show', $producto->id) }}" class="BTN-COMPRAR text-decoration-none d-block text-center py-2 fw-bold text-uppercase tracking-wide" style="border-radius: 10px; transition: all 0.3s ease;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sliders me-2" viewBox="0 0 16 16" style="vertical-align: middle;">
                                <path fill-rule="evenodd" d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3m-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v1z"/>
                            </svg>Configurar Caja
                        </a>
                    </div>

                </div>
            </div>

        @empty

            <div class="col-12">
                <div class="CONTENEDOR-INFO text-center py-5" style="background: rgba(30, 41, 59, 0.6); border-radius: 20px; border: 1px solid rgba(255,255,255,0.1);">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-database-exclamation text-warning mb-3" viewBox="0 0 16 16">
                        <path d="M12.096 6.223A4.92 4.92 0 0 0 13 5.698V7c0 .542-.312 1.034-.841 1.418-.405.293-.944.532-1.547.708l-.167.045a.5.5 0 0 0 .316.949c1.077-.36 1.932-.82 2.455-1.34C13.754 8.243 14 7.662 14 7V5.503a.5.5 0 0 0-.246-.432 4.9 4.9 0 0 0-1.658-.849s-.144.524-.144.533c0 .507-.312 1.012-.84 1.418-.405.293-.944.532-1.547.708l-.167.045a.5.5 0 0 0 .316.949c1.077-.36 1.932-.82 2.455-1.34z"/>
                        <path d="M12.096 11.223a4.92 4.92 0 0 0 .904-.525V12c0 .542-.312 1.034-.841 1.418-.405.293-.944.532-1.547.708l-.167.045a.5.5 0 0 0 .316.949c1.077-.36 1.932-.82 2.455-1.34C13.754 13.243 14 13.662 14 13v-1.5a.5.5 0 0 0-.246-.432 4.9 4.9 0 0 0-1.658-.849z"/>
                        <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-3.5-2a.5.5 0 0 0-.5.5v1.5a.5.5 0 0 0 1 0V11a.5.5 0 0 0-.5-.5m0 4a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
                    </svg>
                    <p class="mb-0 fw-bold text-muted fs-5">
                        No se encontraron productos indexados en la tabla central de MariaDB en este momento.
                    </p>
                    <small class="text-muted d-block mt-2">Por favor, ejecute los comandos de migración o cargue las Mystery Boxes iniciales por consola.</small>
                </div>
            </div>

        @endforelse

    </div>

</div>

@endsection