@extends('plantilla')

@section('contenido')
<div class="container my-5 text-white">
    <div class="border-bottom border-secondary pb-3 mb-5">
        <h1 class="display-5 fw-bold text-uppercase" style="font-family: 'Playfair Display', serif;">Panel Administrativo</h1>
        <p class="text-muted small">Métricas de control para {{ Auth::user()->name }}</p>
    </div>

    <!-- TARJETAS DE MÉTRICAS -->
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="p-4" style="background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 15px;">
                <span class="small text-success fw-bold d-block mb-1 text-uppercase">Ventas Estimadas</span>
                <h2 class="fw-bold m-0">${{ number_format($totalVentasComerciales, 2, ',', '.') }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-4" style="background: rgba(59, 130, 246, 0.15); border: 1px solid rgba(59, 130, 246, 0.3); border-radius: 15px;">
                <span class="small text-info fw-bold d-block mb-1 text-uppercase">Clientes Totales</span>
                <h2 class="fw-bold m-0">{{ $totalUsuarios }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-4" style="background: rgba(245, 158, 11, 0.15); border: 1px solid rgba(245, 158, 11, 0.3); border-radius: 15px;">
                <span class="small text-warning fw-bold d-block mb-1 text-uppercase">Mystery Boxes</span>
                <h2 class="fw-bold m-0">{{ $totalProductos }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-4" style="background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.3); border-radius: 15px;">
                <span class="small text-danger fw-bold d-block mb-1 text-uppercase">Administradores</span>
                <h2 class="fw-bold m-0">{{ $totalAdmins }}</h2>
            </div>
        </div>
    </div>

    <!-- TABLA DE AUDITORÍA RÁPIDA -->
    <div class="p-4" style="background: rgba(30, 41, 59, 0.8); border-radius: 20px; border: 1px solid rgba(255,255,255,0.1);">
        <h4 class="fw-bold mb-4" style="font-family: 'Playfair Display', serif;">Últimos Usuarios Registrados</h4>
        <div class="table-responsive">
            <table class="table table-dark table-hover m-0">
                <thead class="border-bottom border-secondary">
                    <tr class="small text-uppercase opacity-75">
                        <th class="p-3">Nombre</th>
                        <th class="p-3">Email</th>
                        <th class="p-3">Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ultimosUsuarios as $u)
                    <tr>
                        <td class="p-3">{{ $u->name }}</td>
                        <td class="p-3 text-info">{{ $u->email }}</td>
                        <td class="p-3 small">{{ $u->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection