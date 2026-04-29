@extends('plantilla') <!-- Hereda la estructura base desde la plantilla principal -->

@section('contenido') <!-- Inicio de la sección de contenido -->

<!-- Contenedor principal -->
<DIV CLASS="CONTAINER">
    
    <!-- Fila centrada horizontalmente -->
    <DIV CLASS="ROW JUSTIFY-CONTENT-CENTER">
        
        <!-- Columna de ancho medio (8/12) -->
        <DIV CLASS="COL-MD-8">
            
            <!-- Caja que muestra el mensaje de confirmación -->
            <DIV CLASS="MENSAJE-BOX TEXT-CENTER">
                
                <!-- Título principal del mensaje -->
                <H2 CLASS="TITULO-PAGINA">¡MENSAJE RECIBIDO!</H2>
                
                <!-- Mensaje personalizado  -->
                <P CLASS="LEAD MT-4">
                    HOLA <STRONG>{{ $nombre }}</STRONG>, QUÉ BUENO RECIBIR TU MENSAJE. 
                </P>
                
                <!-- Información de contacto mostrando el email ingresado -->
                <P>
                    UN MIEMBRO DEL EQUIPO DE <STRONG>ESENCIA RETRO</STRONG> SE PONDRÁ EN CONTACTO CON USTED AL CORREO: 
                    <BR>
                    <STRONG>{{ $email }}</STRONG>
                </P>

                <!-- Enlace para volver a la página de inicio -->
                <DIV CLASS="MT-5">
                    <A HREF="{{ URL('/') }}" CLASS="LINK-VOLVER">VOLVER AL INICIO</A>
                </DIV>
            
            </DIV>
        </DIV>
    </DIV>
</DIV>
<!-- Fin de la sección -->

@endsection 