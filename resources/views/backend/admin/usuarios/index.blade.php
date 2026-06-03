@extends('plantilla')

@section('contenido')
<div class="container my-5 text-white">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-uppercase" style="font-family: 'Playfair Display', serif;">Gestión de Usuarios</h2>
    </div>

    @if(session('exito'))
        <div class="alert alert-success bg-success text-white border-0 mb-4">{{ session('exito') }}</div>
    @endif

    <div class="table-responsive p-4" style="background: rgba(30, 41, 59, 0.8); border-radius: 20px; border: 1px solid rgba(255,255,255,0.1);">
        <table class="table table-dark align-middle">
            <thead>
                <tr class="text-uppercase small opacity-50">
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $u)
                <tr>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>
                        <span class="badge {{ $u->es_admin ? 'bg-danger' : 'bg-secondary' }}">
                            {{ $u->es_admin ? 'ADMIN' : 'CLIENTE' }}
                        </span>
                    </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('usuarios.edit', $u->id) }}" class="btn btn-sm btn-outline-info">Editar / Rol</a>
                            <form action="{{ route('usuarios.destroy', $u->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este usuario?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection