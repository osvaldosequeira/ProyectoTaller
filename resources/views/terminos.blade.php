@extends('plantilla')

@section('contenido')
<div class="container">
    <div class="CONTENEDOR-TERMINOS">
        <h2 class="TITULO-PAGINA">TÉRMINOS Y USOS</h2>
        
        <div class="accordion" id="accordionRetro">

            <!-- 1. TERMINOS GENERALES -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                        TÉRMINOS Y CONDICIONES GENERALES
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionRetro">
                    <div class="accordion-body">
                        <p>
                            Bienvenido a Esencia Retro. Al acceder y utilizar nuestro sitio web, aceptás cumplir con los presentes términos y condiciones.
                            Estos regulan el uso de nuestros servicios, productos y contenidos, por lo que recomendamos su lectura previa a cualquier compra.
                        </p>

                        <p>
                            Esencia Retro se especializa en la comercialización de indumentaria deportiva retro bajo la modalidad de “mystery box”.
                            Esto implica que el cliente adquiere un producto sorpresa, cuyo contenido específico no se revela previamente.
                        </p>

                        <p>
                            Nos reservamos el derecho de modificar estos términos en cualquier momento. El uso continuo del sitio implica la aceptación
                            de dichas modificaciones.
                        </p>

                        <p>
                            Todo el contenido de esta web (textos, imágenes, diseño) está protegido por derechos de propiedad intelectual y no puede ser
                            reproducido sin autorización.
                        </p>
                    </div>
                </div>
            </div>

            <!-- 2. VENTAS Y PAGOS -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                        POLÍTICAS DE VENTA Y PAGOS
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionRetro">
                    <div class="accordion-body">
                        <p>
    Todos los precios publicados en el sitio se encuentran expresados en pesos argentinos (ARS) 
    y podrán ser modificados sin previo aviso, en función de actualizaciones comerciales, disponibilidad 
    de stock o cambios en el mercado.
</p>

<p>
    Esencia Retro ofrece distintos medios de pago habilitados dentro de la plataforma, incluyendo 
    transferencias bancarias y otras opciones disponibles al momento de la compra. El procesamiento 
    del pedido se realizará una vez acreditado el pago correspondiente.
</p>

<p>
    Al concretar una compra, el cliente declara conocer y aceptar la modalidad “mystery box”, 
    comprendiendo que el producto adquirido es de carácter aleatorio y que no podrá seleccionar 
    una camiseta, equipo o competición específica. No obstante, la empresa se compromete a mantener 
    los estándares de calidad y temática establecidos.
</p>
                    </div>
                </div>
            </div>

            <!-- 3. ENVIOS Y RESPONSABILIDAD -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                        ENVÍOS Y RESPONSABILIDAD
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionRetro">
                    <div class="accordion-body">
                        <p>
    Los envíos son gestionados a través de servicios logísticos externos, por lo que los plazos de entrega 
    son estimados y pueden variar según la ubicación del cliente, la disponibilidad del servicio y factores 
    ajenos a la empresa.
</p>

<p>
    Esencia Retro no se responsabiliza por demoras, reprogramaciones o inconvenientes derivados de la gestión 
    de dichas empresas de transporte. No obstante, se compromete a brindar asistencia y seguimiento del pedido 
    para garantizar una correcta entrega.
</p>

<p>
    El cliente es responsable de proporcionar datos de envío completos y correctos al momento de la compra. 
    Cualquier error, omisión o inconsistencia en la información podrá ocasionar retrasos, costos adicionales 
    o la imposibilidad de concretar la entrega, situaciones que no serán imputables a la empresa.
</p>
                    </div>
                </div>
            </div>

            <!-- 4. CAMBIOS Y DEVOLUCIONES -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
                        CAMBIOS Y DEVOLUCIONES
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionRetro">
                    <div class="accordion-body">
                        <p>
    Debido a la naturaleza del producto comercializado bajo la modalidad “mystery box”, no se aceptarán 
    devoluciones ni cambios basados en preferencias personales, tales como gusto por el equipo, diseño, 
    competición o modelo recibido.
</p>

<p>
    No obstante, en caso de que el producto presente fallas de fabricación, defectos de calidad o no 
    corresponda con las condiciones ofrecidas, el cliente podrá solicitar un cambio dentro de un plazo 
    máximo de 15 días corridos desde la recepción del pedido.
</p>

<p>
    Para gestionar dicho reclamo, el producto deberá encontrarse sin uso, en las mismas condiciones en 
    las que fue entregado, con sus etiquetas originales y embalaje correspondiente. Esencia Retro se 
    reserva el derecho de evaluar cada caso antes de autorizar el cambio.
</p>
                    </div>
                </div>
            </div>

            <!-- 5. GARANTIA -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive">
                        GARANTÍAS Y SOPORTE
                    </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionRetro">
                    <div class="accordion-body">
                        <p>
    Ofrecemos una garantía de 15 días por defectos de fabricación, tales como fallas de costura, 
    errores en el estampado, desgaste prematuro del material, defectos en el tejido, problemas en 
    etiquetas o terminaciones, y cualquier imperfección que afecte la calidad del producto.
</p>

<p>
    Esta garantía cubre exclusivamente fallas de origen y no incluye daños ocasionados por el uso 
    indebido, lavado incorrecto, exposición a condiciones extremas o desgaste natural propio del uso.
</p>
                    </div>
                </div>
            </div>

            <!-- 6. PRIVACIDAD -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix">
                        POLÍTICA DE PRIVACIDAD
                    </button>
                </h2>
                <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionRetro">
                    <div class="accordion-body">
                        <p>
    En Esencia Retro valoramos y respetamos la privacidad de nuestros usuarios. Toda la información 
    personal recopilada a través del sitio web será utilizada exclusivamente para la gestión de pedidos, 
    procesamiento de pagos, coordinación de envíos y mejora de la experiencia del usuario.
</p>

<p>
    Los datos proporcionados serán tratados de manera confidencial y segura, adoptando las medidas 
    necesarias para evitar accesos no autorizados, alteraciones o divulgaciones indebidas.
</p>

<p>
    Esencia Retro no compartirá, venderá ni cederá información personal a terceros sin el consentimiento 
    del usuario, excepto en aquellos casos en los que sea estrictamente necesario para completar servicios 
    vinculados a la operación, como plataformas de pago o empresas de logística.
</p>

<p>
    El usuario podrá, en cualquier momento, solicitar el acceso, rectificación o eliminación de sus datos 
    personales, así como revocar el consentimiento otorgado para su uso, mediante los canales de contacto 
    habilitados por la empresa.
</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection