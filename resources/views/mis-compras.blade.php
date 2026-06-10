@extends('plantilla')

@section('contenido')

<div class="container my-5">

<h1 class="text-center mb-4">
    Mis Compras
</h1>

<div class="table-responsive">

    <table class="table table-dark table-hover">

        <thead>
            <tr>
                <th>ID Venta</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Acción</th>
            </tr>
        </thead>

        <tbody>

        @forelse($ventas as $venta)

            <tr>

                <td>{{ $venta->id }}</td>

                <td>{{ $venta->fecha }}</td>

                <td>
                    ${{ number_format($venta->total,0,',','.') }}
                </td>

                <td>

                    <a href="{{ route('detalle-compra', $venta->id) }}"
                       class="btn btn-warning btn-sm">

                        Ver Detalle

                    </a>

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="4" class="text-center">

                    No existen compras registradas.

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>


</div>

@endsection
