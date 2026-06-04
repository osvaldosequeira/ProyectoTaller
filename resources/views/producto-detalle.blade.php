@extends('plantilla')

@section('contenido')

<div class="CUERPO-PRINCIPAL container my-5">


<div class="row gap-4 justify-content-center">

    <!-- VISTA PRODUCTO -->

    <div class="col-lg-4 CONTENEDOR-MYSTERY text-center p-4">

        <img src="{{ asset('img/' . $producto->imagen) }}"
             alt="{{ $producto->nombre }}"
             class="IMG-MYSTERY img-fluid mb-3">

        <h2 class="TITULO-MYSTERY fw-bold text-white text-uppercase">

            {{ $producto->nombre }}

        </h2>

        <p class="DESCRIPCION-MYSTERY small opacity-75 px-3 mb-0">

            {{ $producto->descripcion }}

        </p>

    </div>

    <!-- CONFIGURACIÓN -->

    <div class="col-lg-7 CONTENEDOR-MYSTERY p-4 text-white">

        <h3 class="TITULO-SECCION-MYSTERY fw-bold mb-4 border-bottom border-secondary pb-2">

            Configurá tu Mystery Box

        </h3>

        <form action="{{ route('carrito.agregar', $producto->id) }}"
              method="POST">

            @csrf

            <p class="SUBTITULO-TAMANIO small fw-bold text-warning text-uppercase mb-3">

                1. Seleccioná el tamaño:

            </p>

            <div class="row g-3 mb-4">

                <div class="col-md-4">

                    <label class="CARD-TAMANIO">

                        <img src="{{ asset('img/1001046267.png') }}"
                             class="IMG-TAMANIO img-fluid mb-2">

                        <input type="radio"
                               name="tamanio"
                               value="Pequeña"
                               class="form-check-input d-block mx-auto mb-1"
                               checked>

                        <span class="fw-bold d-block text-warning small">

                            PEQUEÑA

                        </span>

                        <small class="text-white-50">

                            Precio Base

                        </small>

                    </label>

                </div>

                <div class="col-md-4">

                    <label class="CARD-TAMANIO">

                        <img src="{{ asset('img/1001046268.png') }}"
                             class="IMG-TAMANIO img-fluid mb-2">

                        <input type="radio"
                               name="tamanio"
                               value="Mediana"
                               class="form-check-input d-block mx-auto mb-1">

                        <span class="fw-bold d-block text-warning small">

                            MEDIANA

                        </span>

                        <small class="text-success">

                            +$15.000,00

                        </small>

                    </label>

                </div>

                <div class="col-md-4">

                    <label class="CARD-TAMANIO">

                        <img src="{{ asset('img/1001046269.png') }}"
                             class="IMG-TAMANIO img-fluid mb-2">

                        <input type="radio"
                               name="tamanio"
                               value="Grande"
                               class="form-check-input d-block mx-auto mb-1">

                        <span class="fw-bold d-block text-warning small">

                            GRANDE

                        </span>

                        <small class="text-success">

                            +$30.000,00

                        </small>

                    </label>

                </div>

            </div>

            <button type="submit"
                    class="BTN-COMPRAR BTN-MYSTERY w-100 py-3 border-0 fw-bold text-uppercase">

                Agregar al Carrito

            </button>

        </form>

    </div>

    <!-- TABLA -->

    <div class="col-lg-11 CONTENEDOR-MYSTERY p-4 mt-4 text-white">

        <h3 class="TITULO-SECCION-MYSTERY fw-bold mb-3 border-bottom border-secondary pb-2">

            Pool de Artículos Posibles para esta Caja

        </h3>

        <div class="table-responsive">

            <table class="table table-dark table-borderless align-middle m-0 TABLA-MYSTERY">

                <thead>

                <tr class="HEADER-MYSTERY">

                    <th class="p-3">

                        Remera Histórica

                    </th>

                    <th class="p-3">

                        Especificación

                    </th>

                    <th class="p-3 text-center">

                        Rareza

                    </th>

                </tr>

                </thead>

                <tbody>

                @foreach($remerasPosibles as $remera)

                <tr class="FILA-MYSTERY">

                    <td class="p-3 fw-bold">

                        {{ $remera['equipo'] }}

                    </td>

                    <td class="p-3 text-muted fst-italic">

                        {{ $remera['tipo'] }}

                    </td>

                    <td class="p-3 text-center">

                        <span class="badge {{ $remera['rareza'] == 'Legendaria' ? 'bg-danger' : ($remera['rareza'] == 'Mítica' ? 'bg-warning text-dark' : 'bg-primary') }} text-uppercase">

                            {{ $remera['rareza'] }}

                        </span>

                    </td>

                </tr>

                @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>


</div>

@endsection
