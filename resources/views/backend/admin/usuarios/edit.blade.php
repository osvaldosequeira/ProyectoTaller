@extends('plantilla')

@section('contenido')
<div class="container my-5">
    <div class="FORMULARIO-BOX mx-auto" style="max-width: 550px;">
        <h2 class="TITULO-SECCION mb-4">Modificar Usuario</h2>

        @if ($errors->any())
            <div class="ALERTA-REGISTRO mb-4 p-3">
                <ul class="LISTA-ERRORES margin-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="LABEL-REGISTRO fw-bold small text-uppercase mb-2 d-block">Nombre Completo</label>
                <input type="text" name="name" class="INPUT-REGISTRO" value="{{ $usuario->name }}" required>
            </div>

            <div class="mb-3">
                <label class="LABEL-REGISTRO fw-bold small text-uppercase mb-2 d-block">Correo Electrónico</label>
                <input type="email" name="email" class="INPUT-REGISTRO" value="{{ $usuario->email }}" required>
            </div>

            <div class="mb-4">
                <label class="LABEL-REGISTRO fw-bold small text-uppercase mb-2 d-block">Rol en la Plataforma</label>
                <select name="es_admin" class="INPUT-REGISTRO" required>
                    <option value="0" {{ $usuario->es_admin == 0 ? 'selected' : '' }}>CLIENTE (Acceso Estándar)</option>
                    <option value="1" {{ $usuario->es_admin == 1 ? 'selected' : '' }}>ADMINISTRADOR (Acceso Total)</option>
                </select>
            </div>

            <button type="submit" class="BTN-REGISTRO">Actualizar Registro</button>
            <a href="{{ route('usuarios.index') }}" class="text-center d-block mt-3 text-secondary small text-decoration-none">Cancelar y Volver</a>
        </form>
    </div>
</div>
@endsection