@extends('plantilla')

@section('contenido')
<div class="container">
    <div class="HERO-SECTION">
        <h2>BIENVENIDOS A ESENCIA RETRO</h2>
        <p class="LEAD">TU TIENDA DE CONFIANZA EN CORRIENTES PARA INDUMENTARIA CLÁSICA Y ARTÍCULOS VINTAGE.</p>
    </div>

    <h3 class="TITULO-SECCION">MYSTERY BOX</h3>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col">
            <div class="CARD-PRODUCTO">
                <div class="IMG-CONTAINER">
                    <img src="{{ asset('img/mundial.jpg') }}" alt="CAMISETA MUNDIAL">
                </div>
                <div class="CARD-CUERPO">
                    <h5>CAMISETA RETRO </h5>
                    <h5>MUNDIAL</h5>
                    <p class="PRECIO">$85.000</p>
                    <button class="BTN-COMPRAR">AGREGAR AL CARRITO</button>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="CARD-PRODUCTO">
                <div class="IMG-CONTAINER">
                    <img src="{{ asset('img/libertadores.jpg') }}" alt="CAMISETA LIBERTADORES">
                </div>
                <div class="CARD-CUERPO">
                    <h5>CAMISETA RETRO</h5>
                    <h5>LIBERTADORES</h5>
                    <p class="PRECIO">$85.000</p>
                    <button class="BTN-COMPRAR">AGREGAR AL CARRITO</button>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="CARD-PRODUCTO">
                <div class="IMG-CONTAINER">
                    <img src="{{ asset('img/champions.jpg') }}" alt="CAMISETA CHAMPIONS">
                </div>
                <div class="CARD-CUERPO">
                    <h5>CAMISETA RETRO</h5>
                    <h5>CHAMPIONS</h5>
                    <p class="PRECIO">$85.000</p>
                    <button class="BTN-COMPRAR">AGREGAR AL CARRITO</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection