@extends('plantilla')

@section('contenido')
<div class="container my-5">
    <div class="FORMULARIO-BOX mx-auto" style="max-width: 650px;">
        <h2 class="TITULO-SECCION mb-4">Nueva Mystery Box</h2>
        
        <form action="{{ route('admin.productos.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="LABEL-LOGIN fw-bold small text-uppercase mb-2 d-block">
                    Nombre de la Caja
                </label>
                <input type="text" 
                       name="nombre" 
                       class="INPUT-LOGIN" 
                       placeholder="Ej: Mystery Box de la Libertadores" 
                       required>
            </div>

            <div class="mb-3">
                <label class="LABEL-LOGIN fw-bold small text-uppercase mb-2 d-block">
                    Precio Base ($)
                </label>
                <input type="number" 
                       step="0.01" 
                       name="precio" 
                       class="INPUT-LOGIN" 
                       placeholder="Ej: 45000.00" 
                       required>
            </div>

            <div class="mb-3">
                <label class="LABEL-LOGIN fw-bold small text-uppercase mb-2 d-block">
                    Stock Disponible
                </label>
                <input type="number" 
                       name="stock" 
                       class="INPUT-LOGIN" 
                       placeholder="Ej: 15" 
                       min="0"
                       required>
            </div>

            <div class="mb-3">
                <label class="LABEL-LOGIN fw-bold small text-uppercase mb-2 d-block">
                    Nombre de la Imagen
                </label>
                <input type="text" 
                       name="imagen" 
                       class="INPUT-LOGIN" 
                       placeholder="Ej: caja_libertadores.png" 
                       required>
            </div>

            <div class="mb-3">
                <label class="LABEL-LOGIN fw-bold small text-uppercase mb-2 d-block">
                    Descripción de las Prendas
                </label>
                <textarea name="descripcion" 
                          class="INPUT-LOGIN" 
                          rows="4" 
                          placeholder="Especificá el tipo de hilos o indumentaria..." 
                          required></textarea>
            </div>

            <button type="submit" class="BTN-COMPRAR mt-3">
                Guardar Registro
            </button>

            <a href="{{ route('admin.productos.index') }}" 
               class="text-center d-block mt-3 text-secondary small text-decoration-none">
               Volver Atrás
            </a>
        </form>
    </div>
</div>
@endsection