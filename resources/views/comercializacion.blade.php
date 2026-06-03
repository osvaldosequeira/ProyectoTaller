@extends('plantilla')

@section('contenido')
<div class="CUERPO-PRINCIPAL container my-5">
    
    <!-- Encabezado de la Sección -->
    <div class="HEADER-PRINCIPAL text-center mb-5">
        <h1 class="display-5 fw-bold text-uppercase text-dark" style="font-family: 'Playfair Display', serif;">Centro de Comercialización</h1>
        <p class="text-muted text-uppercase tracking-wider small">Gestión y Facturación de tu Pedido Activo</p>
    </div>

    <!-- Alertas de Notificación -->
    @if(session('exito'))
        <div class="alert alert-success alert-dismissible fade show text-center mb-4" role="alert">
            {{ session('exito') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row gap-4 justify-content-center align-items-start">
        
        <!-- DETALLE COMERCIAL: Tabla Dinámica de Artículos -->
        <div class="col-lg-8 CONTENEDOR-INFO m-0 p-4" style="background: rgba(30, 41, 59, 0.8); backdrop-filter: blur(15px); border-radius: 20px; border: 1px solid rgba(255,255,255,0.1); box-shadow: 0 10px 30px rgba(0,0,0,0.3);">
            <h3 class="fw-bold text-white mb-4 border-bottom border-secondary pb-2" style="font-family: 'Playfair Display', serif;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-bag-check me-2 text-warning" viewBox="0 0 16 16" style="vertical-align: middle;">
                    <path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                </svg>Resumen de Artículos
            </h3>
            
            <div class="table-responsive text-white mb-4">
                <table class="table table-dark table-borderless align-middle m-0" style="background: rgba(15, 23, 42, 0.5); border-radius: 15px; overflow: hidden;">
                    <thead>
                        <tr class="text-uppercase border-bottom border-secondary opacity-75" style="font-family: 'Playfair Display', serif; font-size: 0.9rem;">
                            <th class="p-3">Imagen</th>
                            <th class="p-3">Concepto</th>
                            <th class="p-3 text-center">Cantidad</th>
                            <th class="p-3 text-end">Subtotal</th>
                            <th class="p-3 text-center">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($carrito as $id => $item)
                            <tr class="border-bottom border-secondary border-opacity-25">
                                <td class="p-3">
                                    <img src="{{ asset('img/' . $item['imagen']) }}" alt="{{ $item['nombre'] }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 10px; border: 1px solid rgba(255,255,255,0.2);">
                                </td>
                                <td class="p-3 fw-bold text-uppercase" style="font-size: 0.85rem; max-width: 200px;">
                                    {{ $item['nombre'] }}
                                </td>
                                <td class="p-3 text-center fw-bold fs-5">{{ $item['cantidad'] }}</td>
                                <td class="p-3 text-end fw-bold text-info fs-5">
                                    ${{ number_format($item['precio'] * $item['cantidad'], 2, ',', '.') }}
                                </td>
                                <td class="p-3 text-center">
                                    <!-- Botón para eliminar un ítem específico -->
                                    <form action="{{ route('carrito.eliminar', $id) }}" method="POST" onsubmit="return confirm('¿Desea quitar este producto del pedido?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm border-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-5 text-center text-muted fw-bold">
                                    El carrito se encuentra vacío actualmente.
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

        <!-- LOGÍSTICA: Columna Lateral -->
        <div class="col-lg-3 CONTENEDOR-INFO m-0 p-4 d-flex flex-column justify-content-between text-white" style="background: rgba(30, 41, 59, 0.8); backdrop-filter: blur(15px); border-radius: 20px; border: 1px solid rgba(255,255,255,0.1); min-height: 400px; box-shadow: 0 10px 30px rgba(0,0,0,0.3);">
            <div>
                <h3 class="fw-bold mb-3 border-bottom border-secondary pb-2" style="font-family: 'Playfair Display', serif;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-truck me-2 text-warning" viewBox="0 0 16 16" style="vertical-align: middle;">
                        <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5zm1.294 7.456A2 2 0 0 1 4.737 11H11a1 1 0 0 0 1-1v-1h1l1.482 1.85a.5.5 0 0 0 .11.312V10.5a.5.5 0 0 0-.5.5h-.766a2 2 0 0 1-3.468 0H5.039a2 2 0 0 1-3.746-.044m9.442-7.162A.5.5 0 0 0 10.5 3.5h-9a.5.5 0 0 0-.5.5v5.805a.5.5 0 0 0 .106.311l.307.409a1.5 1.5 0 0 0 1.232.575h6.702a1.5 1.5 0 0 0 1.232-.575l.307-.409A.5.5 0 0 0 11 9.305z"/>
                    </svg>Logística Local
                </h3>
                <p class="small text-justify lh-base opacity-90">
                    Nuestros despachos se coordinan en los puntos de distribución autorizados de <strong>Corrientes Capital</strong> y <strong>San Luis del Palmar</strong>. Al confirmar la orden, los datos se sincronizan con el sistema central de pedidos.
                </p>
                
            </div>

            @if(count($carrito) > 0)
                <div class="mt-4">
                    <form action="{{ route('carrito.confirmar') }}" method="POST">
                        @csrf
                        <button type="submit" class="BTN-COMPRAR w-100 py-3 border-0 fw-bold text-uppercase" style="border-radius: 12px;">
                            Confirmar Operación
                        </button>
                    </form>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection