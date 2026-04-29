@extends('plantilla') <!-- Hereda la estructura principal -->

@section('contenido') <!-- Inicio de la sección de contenido -->

<!-- Contenedor principal -->
<div class="container">
    
    <!-- Sección de bienvenida -->
    <div class="HERO-SECTION">
        
        <!-- Título principal -->
        <h2>BIENVENIDOS A ESENCIA RETRO</h2>
        
        <!-- Descripción -->
        <p class="LEAD">TU TIENDA DE CONFIANZA EN CORRIENTES PARA INDUMENTARIA CLÁSICA Y ARTÍCULOS VINTAGE.</p>
    </div>

    <!-- Título de la sección de productos -->
    <h3 class="TITULO-SECCION">MYSTERY BOX</h3>

    <!-- Fila de productos con diseño responsive  -->
    <div class="row row-cols-1 row-cols-md-3 g-4">
        
        <!-- Producto 1 -->
        <div class="col">
            <div class="CARD-PRODUCTO">
                
                <!-- Contenedor de la imagen -->
                <div class="IMG-CONTAINER">
                    <img src="{{ asset('img/mundial.jpg') }}" alt="CAMISETA MUNDIAL">
                </div>
                
                <!-- Cuerpo de la tarjeta -->
                <div class="CARD-CUERPO">
                    <h5>CAMISETA RETRO </h5>
                    <h5>MUNDIAL</h5>
                    
                    <!-- Precio del producto -->
                    <p class="PRECIO">$85.000</p>
                    
                    <!-- Botón de acción -->
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