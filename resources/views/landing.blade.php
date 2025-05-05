<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido | Plataforma de Alumnos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CDN (v5.3) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

    <div class="text-center">
        <h1 class="mb-4">Bienvenido a la Plataforma de Alumnos</h1>
        <p class="mb-5">Consulta, gestiona y administra la información académica de manera eficiente.</p>

        <a href="{{ route('login') }}" class="btn btn-primary btn-lg me-2">Iniciar Sesión</a>
        <a href="{{ route('register') }}" class="btn btn-success btn-lg">Registrarse</a>
    </div>

</body>
</html>
