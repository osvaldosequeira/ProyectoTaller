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

        <p class="fw-bold text-warning mt-4">

            Stock disponible: {{ $producto->stock }}

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

            <!-- PASO 1 -->

            <p class="SUBTITULO-TAMANIO small fw-bold text-warning text-uppercase mb-3">

                1. Seleccioná el tamaño de caja

            </p>

            <div class="row g-3 mb-4">

                <div class="col-md-4">

                    <label class="CARD-TAMANIO">

                        <img src="{{ asset('img/1001046267.png') }}"
                             class="IMG-TAMANIO img-fluid mb-2">

                        <input type="radio"
                               name="tamanio"
                               value="Pequeña"
                               checked
                               class="form-check-input d-block mx-auto mb-2">

                        <span class="fw-bold d-block text-warning">

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
                               class="form-check-input d-block mx-auto mb-2">

                        <span class="fw-bold d-block text-warning">

                            MEDIANA

                        </span>

                        <small class="text-success">

                            +$15.000

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
                               class="form-check-input d-block mx-auto mb-2">

                        <span class="fw-bold d-block text-warning">

                            GRANDE

                        </span>

                        <small class="text-success">

                            +$30.000

                        </small>

                    </label>

                </div>

            </div>

            <!-- PASO 2 -->

            <p class="SUBTITULO-TAMANIO small fw-bold text-warning text-uppercase mb-3">

                2. Seleccioná talle camiseta

            </p>

            <div class="mb-4">

                <select name="talle"
                        class="form-select">

                    <option value="S">S</option>

                    <option value="M" selected>M</option>

                    <option value="L">L</option>

                    <option value="XL">XL</option>

                </select>

            </div>

            <!-- PASO 3 -->

            <p class="SUBTITULO-TAMANIO small fw-bold text-warning text-uppercase mb-3">

                3. Cantidad

            </p>

            <div class="d-flex justify-content-center align-items-center gap-3 mb-4">

                <button type="button"
                        onclick="restarCantidad()"
                        class="btn btn-secondary">

                    -

                </button>

                <input type="number"
                       id="cantidad"
                       name="cantidad"
                       min="1"
                       value="1"
                       class="form-control text-center"
                       style="width:90px;">

                <button type="button"
                        onclick="sumarCantidad()"
                        class="btn btn-secondary">

                    +

                </button>

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

                <tr>

                    <th>Remera Histórica</th>

                    <th>Especificación</th>

                    <th class="text-center">Rareza</th>

                </tr>

                </thead>

                <tbody>

                @foreach($remerasPosibles as $remera)

                <tr>

                    <td class="fw-bold">

                        {{ $remera['equipo'] }}

                    </td>

                    <td>

                        {{ $remera['tipo'] }}

                    </td>

                    <td class="text-center">

                        <span class="badge {{ $remera['rareza'] == 'Legendaria' ? 'bg-danger' : ($remera['rareza'] == 'Mítica' ? 'bg-warning text-dark' : 'bg-primary') }}">

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

<script>

function sumarCantidad(){

let c=document.getElementById('cantidad');

c.value=parseInt(c.value)+1;

}

function restarCantidad(){

let c=document.getElementById('cantidad');

if(parseInt(c.value)>1){

c.value=parseInt(c.value)-1;

}

}

</script>

@endsection