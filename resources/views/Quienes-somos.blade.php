@extends('plantilla')

@section('contenido')
<div class="CONTENEDOR-INFO">
    <h2 class="TITULO-PAGINA">Quiénes Somos</h2>
    
    <section class="seccion-texto">
        <h4>Nuestra Trayectoria</h4>
        <p>Esencia Retro nació de la pasión por la historia del deporte en Corrientes.</p>
    </section>

    <section class="seccion-staff">
        <h4>Nuestro Staff</h4>
        <div class="row text-center">
            <div class="col-md-6">
                <div class="staff-card">
                    <h6>Osvaldo | Samuel</h6>
                    <p>Fundador</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="staff-card">
                    <h6>Equipo de Curaduría</h6>
                    <p>Especialistas Vintage</p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection