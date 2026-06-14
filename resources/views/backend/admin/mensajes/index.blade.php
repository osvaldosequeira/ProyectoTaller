@extends('plantilla')

@section('contenido')
<div class="container my-5 text-white">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-uppercase" style="font-family: 'Playfair Display', serif;">Gestión de Mensajes / Soporte</h2>
    </div>

    @if(session('exito'))
        <div class="alert alert-success border-0 shadow mb-4" style="background: rgba(34, 197, 94, 0.2); color: #22c55e; border-radius: 12px; font-weight: 600;">
            ✉️ {{ session('exito') }}
        </div>
    @endif
<!-- SECCIÓN DE BUSCADOR Y FILTROS -->
    <div class="p-4 mb-4" style="background: rgba(30, 41, 59, 0.5); border-radius: 15px; border: 1px solid rgba(255,255,255,0.05);">
        <form action="{{ route('admin.mensajes.index') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-5">
                <label for="buscar" class="small text-uppercase opacity-50 fw-bold mb-2 d-block">Buscar en Consultas</label>
                <input type="text" name="buscar" id="buscar" class="form-control bg-dark text-white border-secondary" 
                       placeholder="Nombre, correo o palabras clave..." value="{{ request('buscar') }}">
            </div>
            <div class="col-md-4">
                <label for="tipo" class="small text-uppercase opacity-50 fw-bold mb-2 d-block">Tipo de Remitente</label>
               <select name="tipo" id="tipo" class="form-select bg-dark text-white border-secondary">
    <option value="">Todos los mensajes</option>
    <option value="registrado" {{ request('tipo') === 'registrado' ? 'selected' : '' }}>
        Solo Registrados
    </option>
    <option value="no registrado" {{ request('tipo') === 'no registrado' ? 'selected' : '' }}>
        Solo No Registrados
    </option>
</select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-warning fw-bold w-100 text-uppercase">Filtrar</button>
                @if(request()->has('buscar') || request()->has('tipo'))
                    <a href="{{ route('admin.mensajes.index') }}" class="btn btn-outline-secondary w-50">Limpiar</a>
                @endif
            </div>
        </form>
    </div>
    <div class="table-responsive p-4" style="background: rgba(30, 41, 59, 0.8); border-radius: 20px; border: 1px solid rgba(255,255,255,0.1);">
        <table class="table table-dark align-middle">
            <thead>
                <tr class="text-uppercase small opacity-50" style="font-family: 'Playfair Display', serif;">
                    <th>Remitente</th>
                    <th>Contacto Declarado</th>
                    <th>Mensaje / Consulta</th>
                    <th>Fecha</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mensajes as $m)
                <tr class="FILA-MYSTERY">
                    <td>
                        @if($m->user_id && $m->usuario)
                            <span class="badge bg-info text-uppercase px-2 py-1 mb-1" style="border-radius: 6px; font-size: 0.7rem;">Registrado</span>
                            <a href="{{ route('usuarios.edit', $m->user_id) }}" class="text-warning fw-bold d-block text-decoration-none small">
                                👤 {{ $m->usuario->name }} <br><span class="text-muted small">(Ver Perfil)</span>
                            </a>
                        @else
                            <span class="badge bg-secondary text-uppercase px-2 py-1" style="border-radius: 6px; font-size: 0.7rem;">Mensaje Anónimo</span>
                        @endif
                    </td>

                    <td>
                        <div class="fw-bold text-white">{{ $m->nombre }}</div>
                        <small class="text-white-50">{{ $m->email }}</small>
                    </td>

                    <td style="max-width: 350px;">
                        <p class="small text-justify m-0 opacity-75" style="white-space: pre-line;">{{ $m->mensaje }}</p>
                    </td>

                    <td class="small opacity-50">
                        {{ $m->created_at->format('d/m/Y H:i') }}
                    </td>

                    <td class="text-center">
                        <form action="{{ route('admin.mensajes.destroy', $m->id) }}" method="POST" 
                              onsubmit="return confirm('¿Seguro que querés eliminar esta consulta?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger fw-bold">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5 opacity-50 fw-bold">
                        No se recibieron consultas ni mensajes a través del formulario por el momento.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection