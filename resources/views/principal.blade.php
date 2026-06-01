@extends('plantilla')

@section('contenido')

<div class="CUERPO-PRINCIPAL container-fluid p-0">

    <!-- INFORMACIÓN -->
    <div class="container my-5">

        <div class="CONTENEDOR-INFO">

            <h2 class="fw-bold text-center mb-3">
                BIENVENIDOS A ESENCIA RETRO
            </h2>

            <p class="mb-0">
                Somos una plataforma dedicada a la conservación y comercialización de reliquias textiles deportivas.
                A través de nuestro sistema dinámico de catálogo, podés explorar prendas únicas cargadas de historia.
                Navegá por las distintas pestañas del menú superior para acceder a nuestro stock sincronizado en tiempo real
                con nuestra base de datos MariaDB.
            </p>

        </div>

    </div>

    <!-- CARRUSEL -->
    <div id="carouselPublicidad"
         class="carousel slide"
         data-bs-ride="carousel">

        <!-- INDICADORES -->
        <div class="carousel-indicators">

            <button type="button"
                    data-bs-target="#carouselPublicidad"
                    data-bs-slide-to="0"
                    class="active">
            </button>

            <button type="button"
                    data-bs-target="#carouselPublicidad"
                    data-bs-slide-to="1">
            </button>

            <button type="button"
                    data-bs-target="#carouselPublicidad"
                    data-bs-slide-to="2">
            </button>

        </div>

        <!-- SLIDES -->
        <div class="carousel-inner">

            <!-- SLIDE 1 -->
            <div class="carousel-item active" data-bs-interval="4000">

                <div class="carousel-container-custom">

                    <img src="{{ asset('img/1.jpeg') }}"
                         class="carousel-poster"
                         alt="Colección Nostalgia">

                </div>

                <div class="carousel-caption d-none d-md-block carousel-caption-custom">

                    <h5 class="fw-bold text-uppercase">
                        Colección Nostalgia
                    </h5>

                    <p class="small">
                        Ítems exclusivos por box inspirados en las décadas doradas del fútbol.
                    </p>

                </div>

            </div>

            <!-- SLIDE 2 -->
            <div class="carousel-item" data-bs-interval="4000">

                <div class="carousel-container-custom">

                    <img src="{{ asset('img/2.jpeg') }}"
                         class="carousel-poster"
                         alt="Revelá la Historia">

                </div>

                <div class="carousel-caption d-none d-md-block carousel-caption-custom">

                    <h5 class="fw-bold text-uppercase">
                        Revelá la Historia
                    </h5>

                    <p class="small">
                        Mystery Boxes premium con reliquias únicas y diseño vintage exclusivo.
                    </p>

                </div>

            </div>

            <!-- SLIDE 3 -->
            <div class="carousel-item" data-bs-interval="4000">

                <div class="carousel-container-custom">

                    <img src="{{ asset('img/3.jpeg') }}"
                         class="carousel-poster"
                         alt="La Pasión No Se Elige">

                </div>

                <div class="carousel-caption d-none d-md-block carousel-caption-custom">

                    <h5 class="fw-bold text-uppercase">
                        La Pasión No Se Elige
                    </h5>

                    <p class="small">
                        Reviví la esencia del fútbol clásico con prendas llenas de historia.
                    </p>

                </div>

            </div>

        </div>

        <!-- BOTÓN ANTERIOR -->
        <button class="carousel-control-prev"
                type="button"
                data-bs-target="#carouselPublicidad"
                data-bs-slide="prev">

            <span class="carousel-control-prev-icon"></span>

        </button>

        <!-- BOTÓN SIGUIENTE -->
        <button class="carousel-control-next"
                type="button"
                data-bs-target="#carouselPublicidad"
                data-bs-slide="next">

            <span class="carousel-control-next-icon"></span>

        </button>

    </div>

</div>

@endsection