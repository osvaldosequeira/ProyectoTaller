@extends('plantilla')

@section('contenido')

<div class="container my-5 text-white">


<div class="border-bottom border-secondary pb-3 mb-4">
    <h1 class="display-6 fw-bold">
        Gestión de Ventas
    </h1>
</div>

<div class="p-4 mb-4"
     style="background: rgba(30,41,59,.8);
            border-radius:20px;">

    <form method="GET"
          action="{{ route('admin.ventas.index') }}">

        <div class="row g-3">

            <div class="col-md-4">
                <label class="form-label">
                    Cliente
                </label>

                <input type="text"
                       name="usuario"
                       class="form-control"
                       value="{{ request('usuario') }}">
            </div>

            <div class="col-md-3">
                <label class="form-label">
                    Desde
                </label>

                <input type="date"
                       name="desde"
                       class="form-control"
                       value="{{ request('desde') }}">
            </div>

            <div class="col-md-3">
                <label class="form-label">
                    Hasta
                </label>

                <input type="date"
                       name="hasta"
                       class="form-control"
                       value="{{ request('hasta') }}">
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <button class="btn btn-primary w-100">
                    Buscar
                </button>
            </div>

        </div>

    </form>

</div>

<div class="p-4"
     style="background: rgba(30,41,59,.8);
            border-radius:20px;">

    <div class="table-responsive">

        <table class="table table-dark table-hover">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Detalle</th>
                </tr>
            </thead>

            <tbody>

                @forelse($ventas as $venta)

                <tr>

                    <td>
                        {{ $venta->id }}
                    </td>

                    <td>
                        {{ $venta->usuario->name }}
                    </td>

                    <td>
                        {{ \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y') }}
                    </td>

                    <td>
                        ${{ number_format($venta->total, 2, ',', '.') }}
                    </td>

                    <td>
                        <a href="{{ route('admin.ventas.detalle', $venta->id) }}"
                           class="btn btn-sm btn-info">
                            Ver
                        </a>
                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="5" class="text-center">
                        No hay ventas registradas.
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


</div>

@endsection
