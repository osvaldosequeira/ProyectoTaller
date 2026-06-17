@extends('plantilla')

@section('contenido')

<div class="container my-5">

    <!-- Título principal de la sección -->
    <h1 class="text-center mb-4">
        Mis Compras
    </h1>

    <!-- Contenedor responsivo para la tabla -->
    <div class="table-responsive">

        <table class="table table-dark table-hover">

            <!-- Encabezado de la tabla -->
            <thead>
                <tr>
                    <th>ID Venta</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Acción</th>
                </tr>
            </thead>

            <tbody>

            <!-- Recorre todas las ventas realizadas por el usuario -->
            @forelse($ventas as $venta)

                <tr>

                    <!-- Identificador único de la venta -->
                    <td>{{ $venta->id }}</td>

                    <!-- Fecha en que se realizó la compra -->
                    <td>{{ $venta->fecha }}</td>

                    <!-- Importe total de la venta -->
                    <td>
                        ${{ number_format($venta->total,0,',','.') }}
                    </td>

                    <!-- Botón para visualizar el detalle completo -->
                    <td>

                        <a href="{{ route('detalle-compra', $venta->id) }}"
                           class="btn btn-warning btn-sm">

                            Ver Detalle

                        </a>

                    </td>

                </tr>

            <!-- Mensaje mostrado cuando el usuario no posee compras -->
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