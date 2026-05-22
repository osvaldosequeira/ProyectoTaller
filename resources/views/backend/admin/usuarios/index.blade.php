<!DOCTYPE html>
<html>
<head>
    <title>Usuarios</title>
</head>
<body>

    <h1>Lista de Usuarios</h1>

    @if(session('exito'))
        <p>{{ session('exito') }}</p>
    @endif

    <table border="1" cellpadding="10">

        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
        </tr>

        @foreach($usuarios as $usuario)

            <tr>
                <td>{{ $usuario->id }}</td>
                <td>{{ $usuario->nombre }}</td>
                <td>{{ $usuario->email }}</td>
                <td>{{ $usuario->rol->nombre ?? 'Sin rol' }}</td>
            </tr>

        @endforeach

    </table>

</body>
</html>