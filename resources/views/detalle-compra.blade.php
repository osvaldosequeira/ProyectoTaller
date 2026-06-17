@extends('plantilla')

@section('contenido')

<div class="container my-5">

    <!-- Título principal con el número de la compra -->
    <h1 class="text-center mb-4">
        Detalle de Compra #{{ $venta->id }}
    </h1>

    <!-- Información general de la compra -->
    <div class="mb-4">

        <!-- Fecha en la que se realizó la compra -->
        <p>
            <strong>Fecha:</strong>
            {{ $venta->fecha }}
        </p>

        <!-- Importe total de la compra -->
        <p>
            <strong>Total:</strong>
            ${{ number_format($venta->total,0,',','.') }}
        </p>

    </div>

    <!-- Tabla con el detalle de productos comprados -->
    <div class="table-responsive">

        <table class="table table-dark table-hover">

            <thead>

                <tr>

                    <th>Producto</th>
                    <th>Tamaño</th>
                    <th>Talle</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>

                </tr>

            </thead>

            <tbody>

            <!-- Recorre todos los detalles asociados a la venta -->
            @foreach($venta->detalles as $detalle)

                <tr>

                    <!-- Nombre del producto -->
                    <td>
                        {{ $detalle->producto->nombre ?? 'Producto eliminado' }}
                    </td>

                    <!-- Tamaño seleccionado -->
                    <td>
                        {{ $detalle->tamanio }}
                    </td>

                    <!-- Talle seleccionado -->
                    <td>
                        {{ $detalle->talle }}
                    </td>

                    <!-- Cantidad comprada -->
                    <td>
                        {{ $detalle->cantidad }}
                    </td>

                    <!-- Precio unitario registrado al momento de la compra -->
                    <td>
                        ${{ number_format($detalle->precio_unitario,0,',','.') }}
                    </td>

                    <!-- Subtotal calculado (precio × cantidad) -->
                    <td>
                        ${{ number_format($detalle->precio_unitario * $detalle->cantidad,0,',','.') }}
                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

    <!-- Botón para volver al listado de compras -->
    <div class="mt-4">

        <a href="{{ route('mis-compras') }}"
           class="btn btn-secondary">

            Volver a Mis Compras

        </a>

    </div>

</div>

@endsection