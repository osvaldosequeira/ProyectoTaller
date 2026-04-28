@extends('plantilla')

@section('contenido')
<DIV CLASS="CONTAINER">
    <DIV CLASS="ROW JUSTIFY-CONTENT-CENTER">
        <DIV CLASS="COL-MD-8">
            <DIV CLASS="MENSAJE-BOX TEXT-CENTER">
                <H2 CLASS="TITULO-PAGINA">¡MENSAJE RECIBIDO!</H2>
                
                <P CLASS="LEAD MT-4">
                    HOLA <STRONG>{{ $nombre }}</STRONG>, QUÉ BUENO RECIBIR TU MENSAJE. 
                </P>
                
                <P>
                    UN MIEMBRO DEL EQUIPO DE <STRONG>ESENCIA RETRO</STRONG> SE PONDRÁ EN CONTACTO CON USTED AL CORREO: 
                    <BR>
                    <STRONG>{{ $email }}</STRONG>
                </P>

                <DIV CLASS="MT-5">
                    <A HREF="{{ URL('/') }}" CLASS="LINK-VOLVER">VOLVER AL INICIO</A>
                </DIV>
            </DIV>
        </DIV>
    </DIV>
</DIV>
@endsection