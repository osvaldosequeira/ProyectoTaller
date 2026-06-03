@extends('plantilla')

@section('contenido')
<div class="CUERPO-PRINCIPAL container my-5">
    <div class="row gap-4 justify-content-center">
        
        <!-- Vista Previa de la Caja Base -->
        <div class="col-lg-4 CONTENEDOR-INFO text-center p-4" style="background: rgba(30, 41, 59, 0.8); border-radius: 20px; border: 1px solid rgba(255,255,255,0.1);">
            <img src="{{ asset('img/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="img-fluid mb-3" style="max-height: 300px; object-fit: contain; border-radius: 15px;">
            <h2 class="fw-bold text-white text-uppercase" style="font-family: 'Playfair Display', serif;">{{ $producto->nombre }}</h2>
            <p class="text-justify small opacity-75 px-3 mb-0">{{ $producto->descripcion }}</p>
        </div>

        <!-- Configuración de Tamaño con Precios Diferenciados -->
        <div class="col-lg-7 CONTENEDOR-INFO p-4 text-white" style="background: rgba(30, 41, 59, 0.8); border-radius: 20px; border: 1px solid rgba(255,255,255,0.1);">
            <h3 class="fw-bold mb-4 border-bottom border-secondary pb-2" style="font-family: 'Playfair Display', serif;">Configurá tu Mystery Box</h3>
            
            <form action="{{ route('carrito.agregar', $producto->id) }}" method="POST">
                @csrf
                <p class="small fw-bold text-warning text-uppercase mb-3">1. Seleccioná el tamaño:</p>
                
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="w-100 p-2 text-center" style="background: rgba(15, 23, 42, 0.5); border-radius: 15px; border: 1px solid rgba(255,255,255,0.2); cursor: pointer;">
                            <img src="{{ asset('img/1001046267.png') }}" class="img-fluid mb-2" style="max-height: 100px;">
                            <input type="radio" name="tamanio" value="Pequeña" class="form-check-input d-block mx-auto mb-1" checked>
                            <span class="fw-bold d-block text-warning small">PEQUEÑA</span>
                            <small class="text-white-50">Precio Base</small>
                        </label>
                    </div>

                    <div class="col-md-4">
                        <label class="w-100 p-2 text-center" style="background: rgba(15, 23, 42, 0.5); border-radius: 15px; border: 1px solid rgba(255,255,255,0.2); cursor: pointer;">
                            <img src="{{ asset('img/1001046268.png') }}" class="img-fluid mb-2" style="max-height: 100px;">
                            <input type="radio" name="tamanio" value="Mediana" class="form-check-input d-block mx-auto mb-1">
                            <span class="fw-bold d-block text-warning small">MEDIANA</span>
                            <small class="text-success">+$15.000,00</small>
                        </label>
                    </div>

                    <div class="col-md-4">
                        <label class="w-100 p-2 text-center" style="background: rgba(15, 23, 42, 0.5); border-radius: 15px; border: 1px solid rgba(255,255,255,0.2); cursor: pointer;">
                            <img src="{{ asset('img/1001046269.png') }}" class="img-fluid mb-2" style="max-height: 100px;">
                            <input type="radio" name="tamanio" value="Grande" class="form-check-input d-block mx-auto mb-1">
                            <span class="fw-bold d-block text-warning small">GRANDE</span>
                            <small class="text-success">+$30.000,00</small>
                        </label>
                    </div>
                </div>

                <button type="submit" class="BTN-COMPRAR w-100 py-3 border-0 fw-bold text-uppercase" style="border-radius: 12px;">
                    Agregar al Carrito
                </button>
            </form>
        </div>

        <!-- POOL DE DROPS DINÁMICO (15 artículos) -->
        <div class="col-lg-11 CONTENEDOR-INFO p-4 mt-4 text-white" style="background: rgba(30, 41, 59, 0.8); border-radius: 20px; border: 1px solid rgba(255,255,255,0.1);">
            <h3 class="fw-bold mb-3 border-bottom border-secondary pb-2" style="font-family: 'Playfair Display', serif;">
                Pool de Artículos Posibles para esta Caja
            </h3>
            <div class="table-responsive">
                <table class="table table-dark table-borderless align-middle m-0" style="background: rgba(15, 23, 42, 0.5); border-radius: 15px; overflow: hidden;">
                    <thead>
                        <tr class="text-uppercase border-bottom border-secondary opacity-75" style="font-size: 0.85rem;">
                            <th class="p-3">Remera Histórica</th>
                            <th class="p-3">Especificación</th>
                            <th class="p-3 text-center">Rareza</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($remerasPosibles as $remera)
                            <tr class="border-bottom border-secondary border-opacity-25">
                                <td class="p-3 fw-bold">{{ $remera['equipo'] }}</td>
                                <td class="p-3 text-muted italic">{{ $remera['tipo'] }}</td>
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