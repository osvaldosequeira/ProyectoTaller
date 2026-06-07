@extends('plantilla')

@section('contenido')
<div class="container my-5">
    <div class="FORMULARIO-BOX mx-auto" style="max-width: 650px;">
        <h2 class="TITULO-SECCION mb-4">Editar Mystery Box</h2>
        
        <form action="{{ route('admin.productos.update', $producto->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label class="LABEL-LOGIN fw-bold small text-uppercase mb-2 d-block">Nombre de la Caja</label>
                <input type="text" name="nombre" class="INPUT-LOGIN" value="{{ $producto->nombre }}" required>
            </div>

            <div class="mb-3">
                <label class="LABEL-LOGIN fw-bold small text-uppercase mb-2 d-block">Precio Base ($)</label>
                <input type="number" step="0.01" name="precio" class="INPUT-LOGIN" value="{{ $producto->precio }}" required>
            </div>

            <div class="mb-3">
                <label class="LABEL-LOGIN fw-bold small text-uppercase mb-2 d-block">Nombre de la Imagen</label>
                <input type="text" name="imagen" class="INPUT-LOGIN" value="{{ $producto->imagen }}" required>
            </div>

            <div class="mb-3">
                <label class="LABEL-LOGIN fw-bold small text-uppercase mb-2 d-block">Descripción</label>
                <textarea name="descripcion" class="INPUT-LOGIN" rows="4" required>{{ $producto->descripcion }}</textarea>
            </div>

            <button type="submit" class="BTN-COMPRAR mt-3">Actualizar Cambios</button>
            <a href="{{ route('admin.productos.index') }}" class="text-center d-block mt-3 text-secondary small text-decoration-none">Cancelar</a>
        </form>
    </div>
</div>
@endsection