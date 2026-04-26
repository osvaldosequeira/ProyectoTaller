@extends('plantilla')

@section('contenido')
<div class="container">
    <div class="CONTENEDOR-TERMINOS">
        <h2 class="TITULO-PAGINA">TÉRMINOS Y USOS</h2>
        
        <div class="accordion" id="accordionRetro">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                        POLÍTICAS DE VENTA Y PAGOS
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionRetro">
                    <div class="accordion-body">
                        LOS PRECIOS ESTÁN EXPRESADOS EN PESOS ARGENTINOS. ACEPTAMOS TRANSFERENCIAS Y EFECTIVO.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                        GARANTÍAS Y SOPORTE
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionRetro">
                    <div class="accordion-body">
                        GARANTÍA DE 15 DÍAS POR DEFECTOS DE COSTURA. NO SE ACEPTAN CAMBIOS POR DESGASTE NATURAL.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection