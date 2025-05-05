<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
  
  <header>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="/">
          <img src="{{ asset('assets/images/alumnos.jpg') }}" class="img-fluid">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav me-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">INICIO</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Asignaturas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Docentes</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <div class="container mt-5 mb-5">
    <h1 class="text-center mt-5">SERVICIOS ESCOLARES</h1>
    
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Inicio</li>
        <li class="breadcrumb-item active" aria-current="page">Alumnos</li>
      </ol>
    </nav>

    <div class="panel-heading">
      <h2>Listado de Alumnos</h2>
    </div>

   

    <a href="{{ route('alumnos.create') }}" class="btn btn-success mt-4">AGREGAR</a>
    
    <div class="table-responsive mt-4">
      <table class='table table-striped table-bordered text-center'>
        <thead>
          <tr>
            <th>Numero de Control</th>
            <th>Nombre</th>
            <th>Primer Ap</th>
            <th>Segundo Ap</th>
            <th>ACCIONES</th>
          </tr>
        </thead>
        <tbody>
          @foreach($alumnos as $alumno)
          <tr>
            <td>{{ $alumno->Num_Control }}</td>
            <td>{{ $alumno->Nombre }}</td>
            <td>{{ $alumno->Primer_Ap }}</td>
            <td>{{ $alumno->Segundo_Ap }}</td>
            <td>
              <a href="{{ route('alumnos.show', $alumno->Num_Control) }}" class="btn btn-primary btn-sm">Detalle</a>
              <a href="{{ route('alumnos.edit', $alumno->Num_Control) }}" class="btn btn-warning btn-sm">Editar</a>
              <form action="{{ route('alumnos.destroy', $alumno->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que quieres eliminar este registro?');">Eliminar</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <footer class="text-muted mt-3 mb-3 text-center">
    FOOTER
  </footer>
</body>
</html>