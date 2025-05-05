<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MODIFICAR ALUMNO</title>

  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
</head>
<body>

  <header>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="/">
          <img src="" class="img-fluid">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07"
          aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsExample07">
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
    <h1 class="text-center" style="margin-top: 50px;">SERVICIOS ESCOLARES</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/alumnos">Alumnos</a></li>
        <li class="breadcrumb-item active" aria-current="page">Modificar</li>
      </ol>
    </nav>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="p-4 shadow-lg bg-white rounded">
          <h2 class="mb-4">MODIFICAR ALUMNO</h2>

          <form id="formulario" method="POST" action="{{ route('alumnos.update', $alumno->id) }}" role="form" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="mb-3">
              <label for="Num_Control" class="form-label">Número de Control</label>
              <input class="form-control" name="Num_Control" type="text" id="Num_Control" value="{{$alumno->Num_Control}}" required>
            </div>

            <div class="mb-3">
              <label for="Nombre" class="form-label">Nombre</label>
              <input class="form-control" name="Nombre" type="text" id="Nombre" value="{{$alumno->Nombre}}" required>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="Primer_Ap" class="form-label">Primer Apellido</label>
                <input class="form-control" name="Primer_Ap" type="text" id="Primer_Ap" value="{{$alumno->Primer_Ap}}" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="Segundo_Ap" class="form-label">Segundo Apellido</label>
                <input class="form-control" name="Segundo_Ap" type="text" id="Segundo_Ap" value="{{$alumno->Segundo_Ap}}" required>
              </div>
            </div>

            <div class="mb-3">
              <label for="Fecha_Nac" class="form-label">Fecha de Nacimiento</label>
              <input class="form-control" name="Fecha_Nac" type="date" id="Fecha_Nac" value="{{$alumno->Fecha_Nac}}" required>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="Semestre" class="form-label">Semestre</label>
                <input class="form-control" name="Semestre" type="number" id="Semestre" min="1" max="12" value="{{$alumno->Semestre}}" required>
              </div>

              <div class="col-md-6 mb-3">
                <label for="Carrera" class="form-label">Carrera</label>
                <select name="Carrera" id="Carrera" class="form-select" required>
                  <option disabled>Selecciona una carrera...</option>
                  <option value="Ingeniería en Sistemas" {{ $alumno->Carrera == 'Ingeniería en Sistemas' ? 'selected' : '' }}>Ingeniería en Sistemas</option>
                  <option value="Administración de Empresas" {{ $alumno->Carrera == 'Administración de Empresas' ? 'selected' : '' }}>Administración de Empresas</option>
                  <option value="Contaduría" {{ $alumno->Carrera == 'Contaduría' ? 'selected' : '' }}>Contaduría</option>
                  <option value="Ingeniería Mecatrónica" {{ $alumno->Carrera == 'Ingeniería Mecatrónica' ? 'selected' : '' }}>Ingeniería Mecatrónica</option>
                  <option value="Otra..." {{ $alumno->Carrera == 'Otra...' ? 'selected' : '' }}>Otra...</option>
                </select>
              </div>
            </div>

            <div class="text-center">
              <button type="submit" class="btn btn-success w-50">Guardar</button>
              <a href="/alumnos" class="btn btn-warning w-50 mt-2">Cancelar</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <footer class="text-muted mt-3 mb-3 text-center">
    FOOTER
  </footer>

  <script>
    document.getElementById("formulario").addEventListener("submit", function(event) {
      event.preventDefault(); // Evita el envío automático del formulario

      Swal.fire({
        title: "¿Estás seguro?",
        text: "¿Quieres modificar los datos del alumno?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#28a745",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, modificar",
        cancelButtonText: "Cancelar"
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: "¡Modificado!",
            text: "Los datos han sido actualizados correctamente.",
            icon: "success",
            confirmButtonColor: "#28a745"
          }).then(() => {
            event.target.submit(); // Envía el formulario
          });
        }
      });
    });
  </script>
</body>
</html>
