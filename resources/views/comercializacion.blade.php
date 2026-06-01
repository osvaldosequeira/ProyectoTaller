@extends('plantilla')

@section('contenido')
<div class="CUERPO-PRINCIPAL container">
    <div class="HEADER-PRINCIPAL">
        <h1>Centro de Comercialización</h1>
        <p class="text-muted text-uppercase small">Gestión y Facturación de tu Pedido</p>
    </div>

    <div class="row gap-4 justify-content-center">
        <div class="col-lg-7 CONTENEDOR-INFO m-0">
            <h3 class="fw-bold mb-4 border-bottom border-secondary pb-2"><i class="fas fa-shopping-cart me-2"></i>Resumen de Artículos</h3>
            
            <div class="table-responsive text-white mb-4">
                <table class="table table-dark table-borderless align-middle m-0" style="background: rgba(15, 23, 42, 0.4); border-radius: 15px; overflow: hidden;">
                    <thead>
                        <tr class="text-uppercase border-bottom border-secondary" style="font-family: 'Playfair Display', serif;">
                            <th class="p-3">Concepto</th>
                            <th class="p-3 text-center">Cantidad</th>
                            <th class="p-3 text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="p-3 fw-bold">Mystery Box - Edición Mundialista Premium</td>
                            <td class="p-3 text-center">1</td>
                            <td class="p-3 text-end fw-bold">$45.000,00</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h4 class="text-end mb-0">Total Comercial: <span class="fw-bold text-success">$45.000,00</span></h4>
        </div>

        <div class="col-lg-4 CONTENEDOR-INFO m-0 d-flex flex-column justify-content-between">
            <div>
                <h3 class="fw-bold mb-3 border-bottom border-secondary pb-2"><i class="fas fa-truck me-2"></i>Logística Local</h3>
                <p class="small text-justify">
                    Nuestros despachos comerciales se coordinan directamente en los puntos de distribución de *Corrientes Capital* y *San Luis del Palmar*. Al confirmar la orden, los datos se sincronizan con la tabla central de órdenes de compra.
                </p>
                <p class="small opacity-75 text-justify">
                    Nota: Al ser artículos vintage bajo el formato de caja sorpresa, la selección de hilos y talles es definitiva.
                </p>
            </div>

            <div class="mt-4">
                <a href="{{ url('/backend/usuarios/compra-confirmada') }}" class="BTN-COMPRAR py-3">Confirmar Operación Comercial</a>
            </div>
        </div>
    </div>
</div>
@endsection