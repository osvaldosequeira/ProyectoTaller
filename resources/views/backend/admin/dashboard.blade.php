@extends('plantilla')

@section('contenido')
<div class="container my-5 text-white" id="dashboardMainContainer">
    <div class="header-pdf-only">
    <img src="{{ asset('img/logo.png') }}" alt="Logo" style="height: 60px;"> <h1>Esencia Retro</h1>
    <p>Sistema de Gestión Administrativa | Corrientes, Argentina</p>
</div>
    <!-- CABECERA DEL PANEL OPTIMIZADA -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-5 seccion-no-imprimible">
    <div>
        <h1 class="display-5 fw-bold text-uppercase m-0 TITULO-DASHBOARD" style="font-family: 'Playfair Display', serif; white-space: nowrap;">
            Panel de Control
        </h1>
        <p class="text-muted small m-0 mt-1">
            Métricas globales de auditoría para el administrador
        </p>
    </div>
    <div class="w-100 w-md-auto d-flex justify-content-md-end">
        <button onclick="window.print()" class="btn btn-outline-light fw-bold text-uppercase btn-sm px-4 py-2 w-100 w-md-auto BOTON-DASHBOARD-PRINT" style="display: inline-block !important;">
            🖨️ Imprimir Reporte General
        </button>
    </div>
</div>

    <div class="row g-4 mb-5 seccion-no-imprimible">
        <div class="col-md-4 col-xl-2.4">
            <div class="p-4 h-100" style="background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 15px;">
                <span class="small text-success fw-bold d-block mb-1 text-uppercase">Ingresos Totales</span>
                <h3 class="fw-bold m-0 text-success">${{ number_format($totalVentasComerciales, 2, ',', '.') }}</h3>
                <small class="text-muted fs-7">{{ $totalVentas }} órdenes procesadas</small>
            </div>
        </div>

        <div class="col-md-4 col-xl-2.4">
            <div class="p-4 h-100" style="background: rgba(59, 130, 246, 0.15); border: 1px solid rgba(59, 130, 246, 0.3); border-radius: 15px;">
                <span class="small text-info fw-bold d-block mb-1 text-uppercase">Clientes Registrados</span>
                <h3 class="fw-bold m-0 text-info">{{ $totalUsuarios }}</h3>
                <small class="text-muted fs-7">Cuentas en la plataforma</small>
            </div>
        </div>

        <div class="col-md-4 col-xl-2.4">
            <div class="p-4 h-100" style="background: rgba(245, 158, 11, 0.15); border: 1px solid rgba(245, 158, 11, 0.3); border-radius: 15px;">
                <span class="small text-warning fw-bold d-block mb-1 text-uppercase">Mystery Boxes</span>
                <h3 class="fw-bold m-0 text-warning">{{ $totalProductos }}</h3>
                <small class="text-muted fs-7">Productos en catálogo</small>
            </div>
        </div>

        <div class="col-md-6 col-xl-2.4">
            <div class="p-4 h-100" style="background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.3); border-radius: 15px;">
                <span class="small text-danger fw-bold d-block mb-1 text-uppercase">Administradores</span>
                <h3 class="fw-bold m-0 text-danger">{{ $totalAdmins }}</h3>
                <small class="text-muted fs-7">Usuarios con permisos</small>
            </div>
        </div>

        <div class="col-md-6 col-xl-2.4">
            <div class="p-4 h-100" style="background: rgba(168, 85, 247, 0.15); border: 1px solid rgba(168, 85, 247, 0.3); border-radius: 15px;">
                <span class="small fw-bold d-block mb-1 text-uppercase" style="color: #a855f7;">Mensajes Soporte</span>
                <h3 class="fw-bold m-0" style="color: #a855f7;">{{ count($ultimosMensajes) }}</h3>
                <small class="text-muted fs-7">Consultas sin responder</small>
            </div>
        </div>
    </div>


    <div class="row g-4">

        <div class="col-md-6 bloque-reportable" id="bloque-usuarios">
            <div class="p-4 h-100 wrapper-tabla" style="background: rgba(30, 41, 59, 0.8); border-radius: 20px; border: 1px solid rgba(255,255,255,0.1);">
                <div class="d-flex justify-content-between align-items-center mb-3 cabecera-bloque">
                    <h5 class="fw-bold m-0 text-uppercase tracking-wider" style="font-family: 'Playfair Display', serif;">
                        👤 Últimos Usuarios Registrados
                    </h5>
                    <button onclick="exportarSeccionPDF('bloque-usuarios', 'Reporte de Auditoria - Usuarios')" class="btn btn-sm btn-outline-info fw-bold text-uppercase seccion-no-imprimible">
                        PDF
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-dark table-hover m-0 align-middle small">
                        <thead class="border-bottom border-secondary opacity-75">
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Fecha Registro</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ultimosUsuarios as $u)
                            <tr>
                                <td class="fw-bold text-white">{{ $u->name }}</td>
                                <td class="text-info">{{ $u->email }}</td>
                                <td class="opacity-50">{{ $u->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="3" class="text-center opacity-50 py-3">No hay usuarios recientes.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6 bloque-reportable" id="bloque-productos">
            <div class="p-4 h-100 wrapper-tabla" style="background: rgba(30, 41, 59, 0.8); border-radius: 20px; border: 1px solid rgba(255,255,255,0.1);">
                <div class="d-flex justify-content-between align-items-center mb-3 cabecera-bloque">
                    <h5 class="fw-bold m-0 text-uppercase tracking-wider" style="font-family: 'Playfair Display', serif;">
                        📦 Inventario Crítico / Stock Bajo
                    </h5>
                    <button onclick="exportarSeccionPDF('bloque-productos', 'Reporte de Inventario - Stock Critico')" class="btn btn-sm btn-outline-warning fw-bold text-uppercase seccion-no-imprimible">
                        PDF
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-dark table-hover m-0 align-middle small">
                        <thead class="border-bottom border-secondary opacity-75">
                            <tr>
                                <th>Mystery Box</th>
                                <th>Precio Base</th>
                                <th class="text-center">Stock Físico</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($productosCriticos as $p)
                            <tr>
                                <td class="fw-bold text-white">{{ $p->nombre }}</td>
                                <td class="text-success">${{ number_format($p->precio, 2, ',', '.') }}</td>
                                <td class="text-center">
                                    <span class="badge {{ $p->stock <= 2 ? 'bg-danger text-white' : 'bg-warning text-dark' }} px-2 py-1 fw-bold">
                                        {{ $p->stock }} unidades
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="3" class="text-center opacity-50 py-3">Inventario en niveles óptimos.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6 bloque-reportable" id="bloque-ventas">
            <div class="p-4 h-100 wrapper-tabla" style="background: rgba(30, 41, 59, 0.8); border-radius: 20px; border: 1px solid rgba(255,255,255,0.1);">
                <div class="d-flex justify-content-between align-items-center mb-3 cabecera-bloque">
                    <h5 class="fw-bold m-0 text-uppercase tracking-wider" style="font-family: 'Playfair Display', serif;">
                        💳 Últimas Transacciones Comerciales
                    </h5>
                    <button onclick="exportarSeccionPDF('bloque-ventas', 'Reporte Comercial - Libro de Ventas')" class="btn btn-sm btn-outline-success fw-bold text-uppercase seccion-no-imprimible">
                        PDF
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-dark table-hover m-0 align-middle small">
                        <thead class="border-bottom border-secondary opacity-75">
                            <tr>
                                <th>Nro Factura</th>
                                <th>Cliente / Comprador</th>
                                <th>Total Facturado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ultimasVentas as $v)
                            <tr>
                                <td class="opacity-50">#{{ str_pad($v->id, 6, '0', STR_PAD_LEFT) }}</td>
                                <td class="fw-bold text-white">{{ $v->user->name ?? 'Usuario Invitado' }}</td>
                                <td class="text-success fw-bold">${{ number_format($v->total, 2, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="3" class="text-center opacity-50 py-3">No se registran transacciones recientes.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6 bloque-reportable" id="bloque-mensajes">
            <div class="p-4 h-100 wrapper-tabla" style="background: rgba(30, 41, 59, 0.8); border-radius: 20px; border: 1px solid rgba(255,255,255,0.1);">
                <div class="d-flex justify-content-between align-items-center mb-3 cabecera-bloque">
                    <h5 class="fw-bold m-0 text-uppercase tracking-wider" style="font-family: 'Playfair Display', serif;">
                        ✉️ Consultas Recientes de Soporte
                    </h5>
                    <button onclick="exportarSeccionPDF('bloque-mensajes', 'Reporte Operativo - Bandeja de Consultas')" class="btn btn-sm btn-outline-danger fw-bold text-uppercase seccion-no-imprimible">
                        PDF
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-dark table-hover m-0 align-middle small">
                        <thead class="border-bottom border-secondary opacity-75">
                            <tr>
                                <th>Remitente</th>
                                <th>Consulta General</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ultimosMensajes as $m)
                            <tr>
                                <td>
                                    <div class="fw-bold text-white">{{ $m->nombre }}</div>
                                    <small class="text-info opacity-75">{{ $m->email }}</small>
                                </td>
                                <td class="opacity-75" style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    {{ $m->mensaje }}
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="2" class="text-center opacity-50 py-3">Bandeja de mensajes vacía.</td></tr>
                            @endforelse
                            <script>
    // Asignamos la fecha actual al body para que el CSS la lea
    document.body.setAttribute('data-fecha', new Date().toLocaleDateString('es-AR'));
</script>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>


<script>
    function exportarSeccionPDF(idElemento, stringTitulo) {
        const contenedorPrincipal = document.getElementById('dashboardMainContainer');
        const tituloOriginalDocumento = document.title;

        // Modificamos el título de la pestaña para que el nombre del PDF sea prolijo al guardar
        document.title = stringTitulo + " - Esencia Retro";

        // Activamos los modificadores de CSS para ocultar las otras tablas
        contenedorPrincipal.classList.add('modo-aislado-pdf');
        document.getElementById(idElemento).classList.add('bloque-activo-pdf');

        // Ejecutamos el motor de impresión nativo del explorador
        window.print();

        // Restauramos el estado original del Dashboard inmediatamente después de cerrar el menú de impresión
        contenedorPrincipal.classList.remove('modo-aislado-pdf');
        document.getElementById(idElemento).classList.remove('bloque-activo-pdf');
        document.title = tituloOriginalDocumento;
    }
</script>
@endsection