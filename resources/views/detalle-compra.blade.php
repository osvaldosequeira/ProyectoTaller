@extends('plantilla')

@section('contenido')

<div class="container my-5">


<h1 class="text-center mb-4">
    Detalle de Compra #{{ $venta->id }}
</h1>

<div class="mb-4">

    <p>
        <strong>Fecha:</strong>
        {{ $venta->fecha }}
    </p>

    <p>
        <strong>Total:</strong>
        ${{ number_format($venta->total,0,',','.') }}
    </p>

</div>

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

        @foreach($venta->detalles as $detalle)

            <tr>

                <td>
                    {{ $detalle->producto->nombre ?? 'Producto eliminado' }}
                </td>

                <td>
                    {{ $detalle->tamanio }}
                </td>

                <td>
                    {{ $detalle->talle }}
                </td>

                <td>
                    {{ $detalle->cantidad }}
                </td>

                <td>
                    ${{ number_format($detalle->precio_unitario,0,',','.') }}
                </td>

                <td>
                    ${{ number_format($detalle->precio_unitario * $detalle->cantidad,0,',','.') }}
                </td>

            </tr>

        @endforeach

        </tbody>

    </table>

</div>

<div class="mt-4">

    <a href="{{ route('mis-compras') }}"
       class="btn btn-secondary">

        Volver a Mis Compras

    </a>

</div>


</div>

@endsection
