@extends('plantilla')

@section('contenido')

<div class="CUERPO-PRINCIPAL container my-5">


<div class="HEADER-PRINCIPAL text-center mb-5">

    <h1 class="display-5 fw-bold text-uppercase TITULO-COMERCIAL">

        Centro de Comercialización

    </h1>

    <p class="SUBTITULO-COMERCIAL text-muted text-uppercase small">

        Gestión y Facturación de tu Pedido Activo

    </p>

</div>

@if(session('exito'))

<div class="alert alert-success alert-dismissible fade show text-center mb-4">

    {{ session('exito') }}

    <button type="button"
            class="btn-close"
            data-bs-dismiss="alert">

    </button>

</div>

@endif

<div class="row gap-4 justify-content-center align-items-start">

    <!-- TABLA -->

    <div class="col-lg-8 CONTENEDOR-CARRITO p-4">

        <h3 class="TITULO-BLOQUE fw-bold mb-4 border-bottom border-secondary pb-2">

            <svg xmlns="http://www.w3.org/2000/svg"
                 width="24"
                 height="24"
                 fill="currentColor"
                 class="bi bi-bag-check me-2 text-warning ICONO-MEDIO"
                 viewBox="0 0 16 16">

            </svg>

            Resumen de Artículos

        </h3>

        <div class="table-responsive text-white mb-4">

            <table class="table table-dark table-borderless align-middle m-0 TABLA-CARRITO">

                <thead>

                <tr class="ENCABEZADO-TABLA">

                    <th class="p-3">Imagen</th>
                    <th class="p-3">Concepto</th>
                    <th class="p-3 text-center">Cantidad</th>
                    <th class="p-3 text-end">Subtotal</th>
                    <th class="p-3 text-center">Acción</th>

                </tr>

                </thead>

                <tbody>

                @forelse($carrito as $id => $item)

                <tr class="FILA-CARRITO">

                    <td class="p-3">

                        <img src="{{ asset('img/' . $item['imagen']) }}"
                             alt="{{ $item['nombre'] }}"
                             class="IMG-CARRITO">

                    </td>

                    <td class="p-3 NOMBRE-PRODUCTO">

                        {{ $item['nombre'] }}

                    </td>

                    <td class="p-3 text-center fw-bold fs-5">

                        {{ $item['cantidad'] }}

                    </td>

                    <td class="p-3 text-end fw-bold text-info fs-5">

                        ${{ number_format($item['precio'] * $item['cantidad'],2,',','.') }}

                    </td>

                    <td class="p-3 text-center">

                        <form action="{{ route('carrito.eliminar', $id) }}"
                              method="POST"
                              onsubmit="return confirm('¿Desea quitar este producto del pedido?');">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-outline-danger btn-sm border-0">

                                🗑

                            </button>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="5"
                        class="p-5 text-center text-muted fw-bold">

                        El carrito se encuentra vacío actualmente.

                    </td>

                </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        @if(count($carrito) > 0)

        <div class="text-end pe-2">

            <h4 class="TOTAL-CARRITO">

                Total Comercial:

                <span class="TOTAL-PRECIO">

                    ${{ number_format($total,2,',','.') }}

                </span>

            </h4>

        </div>

        @endif

    </div>

    <!-- PANEL DERECHO -->

    <div class="col-lg-3 CONTENEDOR-CARRITO p-4 d-flex flex-column justify-content-between text-white PANEL-LATERAL">

        <div>

            <h3 class="TITULO-BLOQUE fw-bold mb-3 border-bottom border-secondary pb-2">

                🚚 Logística Local

            </h3>

            <p class="DESCRIPCION-LOGISTICA">

                Nuestros despachos se coordinan en Corrientes Capital y
                San Luis del Palmar.

            </p>

        </div>

        @if(count($carrito) > 0)

        <div class="mt-4">

            <form action="{{ route('carrito.confirmar') }}"
                  method="POST">

                @csrf

                <button type="submit"
                        class="BTN-COMPRAR w-100 py-3 border-0 fw-bold text-uppercase BTN-CONFIRMAR">

                    Confirmar Operación

                </button>

            </form>

        </div>

        @endif

    </div>

</div>


</div>

@endsection
