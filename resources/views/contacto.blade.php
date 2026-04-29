@extends('plantilla') <!-- Indica que esta vista hereda de una plantilla base -->

@section('contenido') <!-- Inicio de la sección de contenido que se insertará en la plantilla -->

<!-- Contenedor principal del formulario -->
<DIV CLASS="CONTAINER">
    
    <!-- Fila que centra el contenido horizontalmente -->
    <DIV CLASS="ROW JUSTIFY-CONTENT-CENTER">
        
        <!-- Columna de tamaño medio (6/12) para centrar el formulario -->
        <DIV CLASS="COL-MD-6">
            
            <!-- Caja que contiene todo el formulario -->
            <DIV CLASS="FORMULARIO-BOX">
                
                <!-- Título de la página -->
                <H2 CLASS="TITULO-PAGINA TEXT-CENTER">CONTACTO</H2>
                
                <!-- Formulario que envía datos a la ruta /contacto usando método POST -->
                <FORM ACTION="{{ URL('/contacto') }}" METHOD="POST">
                    
                    @CSRF 
                    <!-- Token de seguridad para evitar ataques CSRF -->

                    <!-- Campo para ingresar el nombre -->
                    <DIV CLASS="MB-4">
                        <LABEL FOR="nombre" CLASS="ETIQUETA">NOMBRE COMPLETO</LABEL>
                        <INPUT TYPE="TEXT" NAME="nombre" ID="nombre" CLASS="FORM-CONTROL" REQUIRED>
                    </DIV>

                    <!-- Campo para ingresar el correo electrónico -->
                    <DIV CLASS="MB-4">
                        <LABEL FOR="email" CLASS="ETIQUETA">CORREO ELECTRÓNICO</LABEL>
                        <INPUT TYPE="EMAIL" NAME="email" ID="email" CLASS="FORM-CONTROL" REQUIRED>
                    </DIV>

                    <!-- Campo de texto para el mensaje -->
                    <DIV CLASS="MB-4">
                        <LABEL FOR="mensaje" CLASS="ETIQUETA">MENSAJE O CONSULTA</LABEL>
                        <TEXTAREA NAME="mensaje" ID="mensaje" ROWS="4" CLASS="FORM-CONTROL" REQUIRED></TEXTAREA>
                    </DIV>

                    <!-- Botón para enviar el formulario -->
                    <BUTTON TYPE="SUBMIT" CLASS="BTN-ENVIAR">ENVIAR CONSULTA</BUTTON>
                
                </FORM>
            </DIV>

        </DIV>
    </DIV>
</DIV>

@endsection 