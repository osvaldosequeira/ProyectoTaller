@extends('plantilla')

@section('contenido')
<div class="CUERPO-PRINCIPAL container my-5">
    
    <div class="HEADER-PRINCIPAL text-center mb-5">
        <h1 class="display-5 fw-bold text-uppercase text-dark" style="font-family: 'Playfair Display', serif;">Centro de Comercialización</h1>
        <p class="text-muted text-uppercase tracking-wider small">Gestión y Facturación de tu Pedido Activo</p>
    </div>

    @if(session('exito'))
        <div class="alert alert-success alert-dismissible fade show text-center mb-4" role="alert">
            {{ session('exito') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row gap-4 justify-content-center align-items-start">
        
        <div class="col-lg-8 CONTENEDOR-INFO m-0 p-4" style="background: rgba(30, 41, 59, 0.8); backdrop-filter: blur(15px); border-radius: 20px; border: 1px solid rgba(255,255,255,0.1); box-shadow: 0 10px 30px rgba(0,0,0,0.3);">
            <h3 class="fw-bold text-white mb-4 border-bottom border-secondary pb-2" style="font-family: 'Playfair Display', serif;">
                <i class="fas fa-shopping-bag me-2 text-warning"></i>Resumen de Artículos
            </h3>
            
            <div class="table-responsive text-white mb-4">
                <table class="table table-dark table-borderless align-middle m-0" style="background: rgba(15, 23, 42, 0.5); border-radius: 15px; overflow: hidden;">
                    <thead>
                        <tr class="text-uppercase border-bottom border-secondary opacity-75" style="font-family: 'Playfair Display', serif; font-size: 0.9rem;">
                            <th class="p-3">Imagen</th>
                            <th class="p-3">Concepto</th>
                            <th class="p-3 text-center">Cantidad</th>
                            <th class="p-3 text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($carrito as $id => $item)
                            <tr class="border-bottom border-secondary border-opacity-25">
                                <td class="p-3">
                                    <img src="{{ asset('img/' . $item['imagen']) }}" alt="{{ $item['nombre'] }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 10px; border: 1px solid rgba(255,255,255,0.2);">
                                </td>
                                <td class="p-3 fw-bold text-uppercase" style="font-size: 0.95rem; max-width: 250px;">
                                    {{ $item['nombre'] }}
                                </td>
                                <td class="p-3 text-center fw-bold fs-5">{{ $item['cantidad'] }}</td>
                                <td class="p-3 text-end fw-bold text-info fs-5">
                                    ${{ number_format($item['precio'] * $item['cantidad'], 2, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-5 text-center text-muted fw-bold fs-5">
                                    <i class="fas fa-folder-open d-block mb-3 opacity-50" style="font-size: 2.5rem;"></i>
                                    Tu carrito está vacío.<br>
                                    <a href="{{ url('/catalogo') }}" class="btn btn-outline-info btn-sm mt-3 text-uppercase fw-bold">Explorar Catálogo Retro</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(count($carrito) > 0)
                <div class="text-end pe-2">
                    <h4 class="text-white m-0" style="font-family: 'Playfair Display', serif;">
                        Total Comercial: <span class="fw-bold text-success fs-3 ms-2">${{ number_format($total, 2, ',', '.') }}</span>
                    </h4>
                </div>
            @endif
        </div>

        <div class="col-lg-3 CONTENEDOR-INFO m-0 p-4 d-flex flex-column justify-content-between text-white" style="background: rgba(30, 41, 59, 0.8); backdrop-filter: blur(15px); border-radius: 20px; border: 1px solid rgba(255,255,255,0.1); min-height: 380px; box-shadow: 0 10px 30px rgba(0,0,0,0.3);">
            <div>
                <h3 class="fw-bold mb-3 border-bottom border-secondary pb-2" style="font-family: 'Playfair Display', serif;">
                    <!-- REEMPLAZÁ LA ETIQUETA <i> POR ESTE SVG COMPLETO -->
<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16" style="color: white; vertical-align: middle;">
    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a1 1 0 1 0 0 2 1 1 0 0 0 0-2m7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-7 1a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0m7 0a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0"/>
</svg>Logística Local
                </h3>
                <p class="small text-justify lh-base opacity-90">
                    Nuestros despachos comerciales se coordinan directamente en los puntos de distribución autorizados de <strong>Corrientes Capital</strong> y <strong>San Luis del Palmar</strong>. Al confirmar la orden, los datos se sincronizan con la tabla central de órdenes de compra.
                </p>
                
            </div>

            @if(count($carrito) > 0)
                <div class="mt-4">
                    <form action="{{ route('carrito.confirmar') }}" method="POST">
                        @csrf
                        <button type="submit" class="BTN-COMPRAR w-100 py-3 border-0 fw-bold text-uppercase tracking-wider" style="font-family: 'Playfair Display', serif; border-radius: 12px; transition: all 0.3s ease;">
                            Confirmar Operación
                        </button>
                    </form>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection