<!DOCTYPE html>
<html>
<head>
    <title>Roles</title>
</head>
<body>

    <h1>Lista de Roles</h1>

    @if(session('exito'))
        <p>{{ session('exito') }}</p>
    @endif

    <table border="1" cellpadding="10">

        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
        </tr>

        @foreach($roles as $rol)

            <tr>
                <td>{{ $rol->id }}</td>
                <td>{{ $rol->nombre }}</td>
                <td>{{ $rol->descripcion }}</td>
            </tr>

        @endforeach

    </table>

</body>
</html>