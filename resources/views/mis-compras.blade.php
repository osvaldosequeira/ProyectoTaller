@extends('plantilla')

@section('contenido')

<div class="container my-5" id="comprasMainContainer">

    <!-- Título principal de la sección -->
    <h1 class="text-center mb-4 seccion-no-imprimible">
        Mis Compras
    </h1>

    <!-- Formulario de filtros (Se oculta en la impresión) -->
    <form method="GET" class="row g-3 mb-4 seccion-no-imprimible">

        <div class="col-md-3">
            <label class="form-label">ID Compra</label>
            <input type="number" name="venta_id" class="form-control" value="{{ request('venta_id') }}">
        </div>

        <div class="col-md-3">
            <label class="form-label">Desde</label>
            <input type="date" name="desde" class="form-control" value="{{ request('desde') }}">
        </div>

        <div class="col-md-3">
            <label class="form-label">Hasta</label>
            <input type="date" name="hasta" class="form-control" value="{{ request('hasta') }}">
        </div>

        <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-warning me-2">Filtrar</button>
            <a href="{{ route('mis-compras') }}" class="btn btn-secondary">Limpiar</a>
        </div>

    </form>

    <!-- Contenedor responsivo para la tabla -->
    <div class="table-responsive p-3 bloque-reportable" id="bloque-tabla-compras">

        <table class="table table-dark table-hover align-middle">

            <!-- Encabezado de la tabla -->
            <thead>
                <tr>
                    <th>ID Venta</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th class="seccion-no-imprimible">Acción</th>
                </tr>
            </thead>

            <tbody>

            <!-- Recorre todas las ventas realizadas por el usuario -->
            @forelse($ventas as $venta)

                <tr>
                    <!-- Identificador único de la venta -->
                    <td class="fw-bold">#{{ $venta->id }}</td>

                    <!-- Fecha en que se realizó la compra -->
                    <td>{{ \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y') }}</td>

                    <!-- Importe total de la venta -->
                    <td class="text-success fw-bold">
                        ${{ number_format($venta->total, 2, ',', '.') }}
                    </td>

                    <!-- Botones de Acción (Se ocultan al generar el PDF) -->
                    <td class="seccion-no-imprimible">
                        <div class="d-flex gap-2">
                            <a href="{{ route('detalle-compra', $venta->id) }}" class="btn btn-warning btn-sm fw-bold">
                                Ver Detalle
                            </a>
                            
                            <!-- Botón para disparar la Factura PDF del Cliente -->
                            <button type="button" 
                                    class="btn btn-sm btn-outline-light fw-bold"
                                    onclick="imprimirTicketCliente('{{ $venta->id }}', '{{ \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y') }}', '${{ number_format($venta->total, 2, ',', '.') }}')">
                                📄 Ticket
                            </button>
                        </div>
                    </td>
                </tr>

            <!-- Mensaje mostrado cuando el usuario no posee compras -->
            @empty

                <tr>
                    <td colspan="4" class="text-center py-4 opacity-50">
                        No existen compras registradas.
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    <!-- RECIPIENTE INTEGRADO PARA RENDERIZAR LA FACTURA (OCULTO EN WEB) -->
    <div id="ticketImpresionCliente" class="header-pdf-only text-dark p-4" style="display: none;"></div>

</div>

<!-- MOTOR DE GENERACIÓN DE COMPROBANTES DE COMPRA -->
<script>
    function imprimirTicketCliente(idVenta, fecha, total) {
        const contenedorTicket = document.getElementById('ticketImpresionCliente');
        const contenedorMain = document.getElementById('comprasMainContainer');
        const tituloOriginal = document.title;

        // Maquetación de la factura con estilos inline directos para evitar herencias de grises de la web
        contenedorTicket.innerHTML = `
            <div style="border: 2px solid #000; padding: 30px; font-family: 'Segoe UI', Arial, sans-serif; background: #fff; max-width: 700px; margin: 0 auto;">
                <div style="text-align: center; border-bottom: 2px dashed #000; padding-bottom: 15px; margin-bottom: 25px;">
                    <h2 style="font-family: 'Playfair Display', serif; margin: 0; text-transform: uppercase; letter-spacing: 2px; color: #000;">Esencia Retro</h2>
                    <p style="margin: 5px 0 0 0; font-size: 11pt; color: #333;">Comprobante de Compra Oficial</p>
                    <p style="margin: 2px 0 0 0; font-size: 9pt; color: #666;">¡Gracias por tu confianza!</p>
                </div>
                
                <table style="width: 100%; margin-bottom: 30px; font-size: 11pt; color: #000;">
                    <tr>
                        <td style="padding: 5px 0;"><strong>Código de Operación:</strong> #` + idVenta + `</td>
                        <td style="text-align: right; padding: 5px 0;"><strong>Fecha de Compra:</strong> ` + fecha + `</td>
                    </tr>
                </table>

                <table style="width: 100%; border-collapse: collapse; margin-bottom: 35px; color: #000;">
                    <thead>
                        <tr style="background-color: #f5f5f5; border: 1px solid #000;">
                            <th style="padding: 10px; text-align: left; border: 1px solid #000;">Detalle del Producto</th>
                            <th style="padding: 10px; text-align: center; border: 1px solid #000; width: 80px;">Cant.</th>
                            <th style="padding: 10px; text-align: right; border: 1px solid #000; width: 130px;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding: 12px; border: 1px solid #000;">Adquisición de Mystery Box - Catálogo Esencia Retro</td>
                            <td style="padding: 12px; text-align: center; border: 1px solid #000;">1</td>
                            <td style="padding: 12px; text-align: right; border: 1px solid #000; font-weight: bold;">` + total + `</td>
                        </tr>
                    </tbody>
                </table>

                <div style="text-align: right; margin-top: 20px; font-size: 14pt; color: #000;">
                    <strong>TOTAL ABONADO: <span style="border-bottom: 3px double #000; padding-bottom: 2px;">` + total + `</span></strong>
                </div>

                <div style="margin-top: 70px; text-align: center; border-top: 1px solid #ddd; padding-top: 15px; font-size: 9pt; color: #555; font-style: italic;">
                    Este documento constituye un comprobante válido de los artículos adquiridos en la plataforma en línea de Esencia Retro.
                </div>
            </div>
        `;

        // Modifica dinámicamente el nombre de descarga sugerido en la ventana del sistema
        document.title = "Mi_Comprobante_Esencia_Retro_" + idVenta;

        // Transición de aislamiento visual para impresión
        contenedorMain.classList.add('modo-aislado-pdf');
        contenedorTicket.classList.add('bloque-activo-pdf');

        // Invoca el proceso de impresión del cliente web
        window.print();

        // Reestablece la interfaz al estado original de navegación
        contenedorMain.classList.remove('modo-aislado-pdf');
        contenedorTicket.classList.remove('bloque-activo-pdf');
        contenedorTicket.innerHTML = "";
        document.title = tituloOriginal;
    }
</script>

@endsection