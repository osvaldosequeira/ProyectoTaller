@extends('plantilla')

@section('contenido')
<div class="container my-5 text-white">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-uppercase" style="font-family: 'Playfair Display', serif;">
            Gestión de Productos
        </h2>

        <a href="{{ route('admin.productos.create') }}" 
           class="btn btn-warning fw-bold text-uppercase">
            Nueva Mystery Box
        </a>
    </div>

    @if(session('exito'))
        <div class="alert alert-success border-0 shadow mb-4"
             style="background: rgba(34, 197, 94, 0.2); color: #22c55e; border-radius: 12px; font-weight: 600;">
            📊 {{ session('exito') }}
        </div>
    @endif

    <div class="table-responsive p-4"
         style="background: rgba(30, 41, 59, 0.8); border-radius: 20px; border: 1px solid rgba(255,255,255,0.1);">

        <table class="table table-dark align-middle">

            <thead>
                <tr class="text-uppercase small opacity-50"
                    style="font-family: 'Playfair Display', serif;">

                    <th>Caja</th>
                    <th>Nombre</th>
                    <th>Precio Base</th>
                    <th>Stock</th>
                    <th class="text-center">Acciones</th>

                </tr>
            </thead>

            <tbody>

                @foreach($productos as $p)

                <tr class="FILA-MYSTERY">

                    <td>
                        <img src="{{ asset('img/'.$p->imagen) }}"
                             alt="{{ $p->nombre }}"
                             style="height: 50px; width: 50px; object-fit: contain; border-radius: 8px; background: rgba(15, 23, 42, 0.4); border: 1px solid rgba(255,255,255,0.1);">
                    </td>

                    <td class="fw-bold text-white">
                        {{ $p->nombre }}
                    </td>

                    <td class="text-success fw-bold">
                        ${{ number_format($p->precio, 2, ',', '.') }}
                    </td>

                    <td class="fw-bold">
                        {{ $p->stock }}
                    </td>

                    <td class="text-center">

                        <div class="d-flex justify-content-center gap-2">

                            <a href="{{ route('admin.productos.edit', $p->id) }}"
                               class="btn btn-sm btn-outline-warning fw-bold">
                                Editar
                            </a>

                            <form action="{{ route('admin.productos.destroy', $p->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('¿Seguro que querés eliminar la {{ $p->nombre }} de la base de datos?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-sm btn-outline-danger fw-bold">
                                    Borrar
                                </button>

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