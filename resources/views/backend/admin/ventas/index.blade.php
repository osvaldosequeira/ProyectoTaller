@extends('plantilla')

@section('contenido')

<div class="container my-5 text-white" id="ventasMainContainer">

<div class="d-flex justify-content-between align-items-center mb-4 seccion-no-imprimible">
    <h2 class="fw-bold text-uppercase"
        style="font-family: 'Playfair Display', serif;">
        Gestión de Ventas
    </h2>
</div>

<!-- FILTROS -->
<div class="p-4 mb-4 seccion-no-imprimible"
     style="background: rgba(30, 41, 59, 0.5);
            border-radius: 15px;
            border: 1px solid rgba(255,255,255,0.05);">

    <form method="GET"
          action="{{ route('admin.ventas.index') }}"
          class="row g-3 align-items-end">

        <div class="col-md-4">
            <label class="small text-uppercase opacity-50 fw-bold mb-2 d-block">
                Cliente
            </label>

            <input type="text"
                   name="usuario"
                   class="form-control bg-dark text-white border-secondary"
                   placeholder="Nombre del cliente..."
                   value="{{ request('usuario') }}">
        </div>

        <div class="col-md-3">
            <label class="small text-uppercase opacity-50 fw-bold mb-2 d-block">
                Desde
            </label>

            <input type="date"
                   name="desde"
                   class="form-control bg-dark text-white border-secondary"
                   value="{{ request('desde') }}">
        </div>

        <div class="col-md-3">
            <label class="small text-uppercase opacity-50 fw-bold mb-2 d-block">
                Hasta
            </label>

            <input type="date"
                   name="hasta"
                   class="form-control bg-dark text-white border-secondary"
                   value="{{ request('hasta') }}">
        </div>

        <div class="col-md-2 d-flex gap-2">
            <button type="submit"
                    class="btn btn-warning fw-bold w-100 text-uppercase">
                Filtrar
            </button>

            @if(request()->has('usuario') || request()->has('desde') || request()->has('hasta'))
                <a href="{{ route('admin.ventas.index') }}"
                   class="btn btn-outline-secondary text-white border-secondary">
                    Limpiar
                </a>
            @endif
        </div>

    </form>

</div>

<!-- TABLA GESTIÓN DE VENTAS -->
<div class="table-responsive p-4 bloque-reportable"
     id="bloque-tabla-ventas"
     style="background: rgba(30, 41, 59, 0.8);
            border-radius: 20px;
            border: 1px solid rgba(255,255,255,0.1);">

    <table class="table table-dark table-hover align-middle m-0">

        <thead>
            <tr class="text-uppercase small opacity-50"
                style="font-family: 'Playfair Display', serif;">
                <th>ID</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Total</th>
                <th class="text-center seccion-no-imprimible">Acciones</th>
            </tr>
        </thead>

        <tbody>

            @forelse($ventas as $venta)

            <tr>
                <td class="fw-bold">
                    #{{ $venta->id }}
                </td>

                <td class="text-white fw-bold">
                    {{ $venta->usuario->name }}
                </td>

                <td>
                    {{ \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y') }}
                </td>

                <td class="text-success fw-bold">
                    ${{ number_format($venta->total, 2, ',', '.') }}
                </td>

                <td class="text-center seccion-no-imprimible">
                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('admin.ventas.detalle', $venta->id) }}"
                           class="btn btn-sm btn-outline-info fw-bold">
                            Ver
                        </a>
                        <!-- Botón Dinámico para Generar e Imprimir Factura Electrónica -->
                        <button type="button" 
                                class="btn btn-sm btn-outline-success fw-bold"
                                onclick="imprimirComprobante('{{ $venta->id }}', '{{ $venta->usuario->name }}', '{{ \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y') }}', '${{ number_format($venta->total, 2, ',', '.') }}')">
                            📄 PDF
                        </button>
                    </div>
                </td>
            </tr>

            @empty

            <tr>
                <td colspan="5"
                    class="text-center py-4 opacity-50 fw-bold">
                    No hay ventas registradas.
                </td>
            </tr>

            @endforelse

        </tbody>

    </table>

</div>

<!-- CONTENEDOR DINÁMICO OCULTO EN WEB - SOLO ACTIVO EN IMPRESIÓN PDF -->
<div id="comprobanteImpresion" class="header-pdf-only text-dark p-4" style="display: none;">
    <!-- El script va a rellenar este bloque estructurado como factura oficial -->
</div>

</div>

<!-- MOTOR DE GENERACIÓN DE COMPROBANTES DE AUDITORÍA -->
<script>
    function imprimirComprobante(idVenta, cliente, fecha, total) {
        const contenedorComprobante = document.getElementById('comprobanteImpresion');
        const contenedorPrincipal = document.getElementById('ventasMainContainer');
        const tituloOriginal = document.title;

        // Estructuración del Comprobante Oficial bajo estándares administrativos
        contenedorComprobante.innerHTML = `
            <div style="border: 2px solid #000; padding: 25px; font-family: 'Segoe UI', sans-serif;">
                <div style="text-align: center; border-bottom: 2px dashed #000; padding-bottom: 15px; margin-bottom: 20px;">
                    <h2 style="font-family: 'Playfair Display', serif; margin: 0; text-transform: uppercase; letter-spacing: 2px;">Esencia Retro</h2>
                    <p style="margin: 5px 0 0 0; font-size: 10pt; color: #555;">Comprobante de Pago Electrónico - Control Interno</p>
                    <p style="margin: 2px 0 0 0; font-size: 9pt; color: #777;">Corrientes, Argentina</p>
                </div>
                
                <table style="width: 100%; margin-bottom: 25px; font-size: 11pt;">
                    <tr>
                        <td style="padding: 5px 0;"><strong>Nro. Transacción:</strong> #` + idVenta + `</td>
                        <td style="text-align: right; padding: 5px 0;"><strong>Fecha de Emisión:</strong> ` + fecha + `</td>
                    </tr>
                    <tr>
                        <td style="padding: 5px 0; colspan="2""><strong>Cliente Responsable:</strong> ` + cliente + `</td>
                    </tr>
                </table>

                <table style="width: 100%; border-collapse: collapse; margin-bottom: 30px;">
                    <thead>
                        <tr style="background-color: #f2f2f2; border-bottom: 1px solid #000;">
                            <th style="padding: 8px; text-align: left; border: 1px solid #000;">Concepto / Ítem</th>
                            <th style="padding: 8px; text-align: center; border: 1px solid #000; width: 100px;">Cantidad</th>
                            <th style="padding: 8px; text-align: right; border: 1px solid #000; width: 15px;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding: 10px; border: 1px solid #000;">Adquisición en Catálogo Digital (Mystery Boxes)</td>
                            <td style="padding: 10px; text-align: center; border: 1px solid #000;">1</td>
                            <td style="padding: 10px; text-align: right; border: 1px solid #000; font-weight: bold;">` + total + `</td>
                        </tr>
                    </tbody>
                </table>

                <div style="text-align: right; margin-top: 20px; font-size: 13pt;">
                    <strong>TOTAL PAGADO: <span style="border-bottom: 3px double #000; padding-bottom: 2px;">` + total + `</span></strong>
                </div>

                <div style="margin-top: 50px; text-align: center; border-top: 1px solid #ccc; padding-top: 10px; font-size: 8pt; color: #666;">
                    Este documento sirve como comprobante de pago comercial de auditoría interna de sistemas para la UNNE.
                </div>
            </div>
        `;

        // Modificamos metadatos para el nombre automático del guardado del PDF
        document.title = "Comprobante_Venta_" + idVenta + "_" + cliente.replace(/ /g, "_") + " - Esencia Retro";

        // Aislamos el div inyectado activando los modificadores CSS de impresión
        contenedorPrincipal.classList.add('modo-aislado-pdf');
        contenedorComprobante.classList.add('bloque-activo-pdf');

        // Disparamos la impresión nativa del motor de Chrome/Edge
        window.print();

        // Limpieza y restauración inmediata del estado de la interfaz web
        contenedorPrincipal.classList.remove('modo-aislado-pdf');
        contenedorComprobante.classList.remove('bloque-activo-pdf');
        contenedorComprobante.innerHTML = "";
        document.title = tituloOriginal;
    }
</script>

@endsection