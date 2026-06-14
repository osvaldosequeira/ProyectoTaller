@extends('plantilla')

@section('contenido')
<div class="container my-5 text-white">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-uppercase" style="font-family: 'Playfair Display', serif;">Gestión de Usuarios</h2>
        <a href="{{ route('usuarios.create') }}" class="btn btn-warning fw-bold text-uppercase">Nuevo Usuario</a>
    </div>

    @if(session('exito'))
        <div class="alert alert-success border-0 shadow mb-4" style="background: rgba(34, 197, 94, 0.2); color: #22c55e; border-radius: 12px; font-weight: 600;">
            👤 {{ session('exito') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger border-0 shadow mb-4" style="background: rgba(220, 53, 69, 0.2); color: #f8d7da; border-radius: 12px; font-weight: 600;">
            ⚠️ {{ session('error') }}
        </div>
    @endif

    <!-- SECCIÓN DE BUSCADOR Y FILTROS INTERACTIVOS -->
    <div class="p-4 mb-4" style="background: rgba(30, 41, 59, 0.5); border-radius: 15px; border: 1px solid rgba(255,255,255,0.05);">
        <form action="{{ route('usuarios.index') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-5">
                <label for="buscar" class="small text-uppercase opacity-50 fw-bold mb-2 d-block">Buscar Usuario</label>
                <input type="text" name="buscar" id="buscar" class="form-control bg-dark text-white border-secondary" 
                       placeholder="Nombre o correo electrónico..." value="{{ request('buscar') }}">
            </div>
            <div class="col-md-4">
                <label for="rol" class="small text-uppercase opacity-50 fw-bold mb-2 d-block">Filtrar por Rol</label>
                <select name="rol" id="rol" class="form-select bg-dark text-white border-secondary">
                    <option value="">Todos los roles</option>
                    <option value="1" {{ request('rol') === '1' ? 'selected' : '' }}>Administradores</option>
                    <option value="0" {{ request('rol') === '0' ? 'selected' : '' }}>Clientes</option>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-warning fw-bold w-100 text-uppercase">Filtrar</button>
                @if(request()->has('buscar') || request()->has('rol'))
                    <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary w-50 text-white border-secondary">Limpiar</a>
                @endif
            </div>
        </form>
    </div>

    <!-- TABLA DE RESULTADOS -->
    <div class="table-responsive p-4" style="background: rgba(30, 41, 59, 0.8); border-radius: 20px; border: 1px solid rgba(255,255,255,0.1);">
        <table class="table table-dark align-middle m-0">
            <thead>
                <tr class="text-uppercase small opacity-50" style="font-family: 'Playfair Display', serif;">
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($usuarios as $user)
                <tr class="FILA-MYSTERY">
                    <td class="fw-bold text-white">{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->es_admin == 1)
                            <span class="badge bg-danger text-uppercase px-2 py-1" style="border-radius: 6px; font-size: 0.75rem;">Admin</span>
                        @else
                            <span class="badge bg-secondary text-uppercase px-2 py-1" style="border-radius: 6px; font-size: 0.75rem;">Cliente</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('usuarios.edit', $user->id) }}" class="btn btn-sm btn-outline-info fw-bold">Editar / Rol</a>
                            
                            <form action="{{ route('usuarios.destroy', $user->id) }}" method="POST" 
                                  onsubmit="return confirm('¿Seguro que querés eliminar permanentemente a {{ $user->name }} del sistema?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger fw-bold">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4 opacity-50 fw-bold">
                        No se encontraron usuarios que coincidan con los criterios de búsqueda.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection