@extends('plantilla')

@section('contenido')
<DIV CLASS="CONTAINER">
    <DIV CLASS="ROW JUSTIFY-CONTENT-CENTER">
        <DIV CLASS="COL-MD-6">
            
            <DIV CLASS="FORMULARIO-BOX">
                <H2 CLASS="TITULO-PAGINA TEXT-CENTER">CONTACTO</H2>
                
                <FORM ACTION="{{ URL('/contacto') }}" METHOD="POST">
                    
                    @CSRF 

                    <DIV CLASS="MB-4">
                        <LABEL FOR="nombre" CLASS="ETIQUETA">NOMBRE COMPLETO</LABEL>
                        <INPUT TYPE="TEXT" NAME="nombre" ID="nombre" CLASS="FORM-CONTROL" REQUIRED>
                    </DIV>

                    <DIV CLASS="MB-4">
                        <LABEL FOR="email" CLASS="ETIQUETA">CORREO ELECTRÓNICO</LABEL>
                        <INPUT TYPE="EMAIL" NAME="email" ID="email" CLASS="FORM-CONTROL" REQUIRED>
                    </DIV>

                    <DIV CLASS="MB-4">
                        <LABEL FOR="mensaje" CLASS="ETIQUETA">MENSAJE O CONSULTA</LABEL>
                        <TEXTAREA NAME="mensaje" ID="mensaje" ROWS="4" CLASS="FORM-CONTROL" REQUIRED></TEXTAREA>
                    </DIV>

                    <BUTTON TYPE="SUBMIT" CLASS="BTN-ENVIAR">ENVIAR CONSULTA</BUTTON>
                </FORM>
            </DIV>

        </DIV>
    </DIV>
</DIV>
@endsection