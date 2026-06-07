@extends('plantilla')

@section('contenido')
<div class="container my-5">
    <div class="FORMULARIO-BOX mx-auto" style="max-width: 550px;">
        <h2 class="TITULO-SECCION mb-4">Nuevo Usuario Admin / Cliente</h2>

        @if ($errors->any())
            <div class="ALERTA-REGISTRO mb-4 p-3">
                <ul class="LISTA-ERRORES margin-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('usuarios.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="LABEL-REGISTRO fw-bold small text-uppercase mb-2 d-block">Nombre Completo</label>
                <input type="text" name="name" class="INPUT-REGISTRO" placeholder="Ej: Juan Pérez" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label class="LABEL-REGISTRO fw-bold small text-uppercase mb-2 d-block">Correo Electrónico</label>
                <input type="email" name="email" class="INPUT-REGISTRO" placeholder="ejemplo@gmail.com" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label class="LABEL-REGISTRO fw-bold small text-uppercase mb-2 d-block">Contraseña Inicial</label>
                <input type="password" name="password" class="INPUT-REGISTRO" placeholder="Mínimo 8 caracteres" required>
                <span class="INFO-PASSWORD d-block small mt-1 opacity-75">*Requisito: Debe contener al menos 8 caracteres.</span>
            </div>

            <div class="mb-4">
                <label class="LABEL-REGISTRO fw-bold small text-uppercase mb-2 d-block">Asignar Rol</label>
                <select name="es_admin" class="INPUT-REGISTRO" required>
                    <option value="0" selected>CLIENTE (Acceso Estándar)</option>
                    <option value="1">ADMINISTRADOR (Acceso Total)</option>
                </select>
            </div>

            <button type="submit" class="BTN-REGISTRO">Crear Cuenta</button>
            <a href="{{ route('usuarios.index') }}" class="text-center d-block mt-3 text-secondary small text-decoration-none">Volver al Listado</a>
        </form>
    </div>
</div>
@endsection