<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Detalle de alumno">
  <meta name="theme-color" content="#000000">
  <title>Detalle de Alumno</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <style>
    .detail-card {
      border: none;
      box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
      border-radius: 0.5rem;
    }
    .detail-item {
      border-bottom: 1px solid #eee;
      padding: 1rem 0;
    }
    .detail-item:last-child {
      border-bottom: none;
    }
    .detail-label {
      font-weight: 600;
      color: #555;
    }
    .detail-value {
      color: #333;
    }
  </style>
</head>

<body>
  <header>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <img src="../../static/assets/images/estudiantes.png" class="img-fluid" width="40">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
          <ul class="navbar-nav me-auto">
            <li class="nav-item">
              <a class="nav-link active" href="#"><i class="bi bi-house-door"></i> INICIO</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"><i class="bi bi-book"></i> Asignaturas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"><i class="bi bi-person-vcard"></i> Docentes</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <div class="container mt-5 pt-4 mb-5">
    <div class="row">
      <div class="col-12">
        <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="/alumnos"><i class="bi bi-people"></i> Alumnos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detalle</li>
          </ol>
        </nav>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="detail-card p-4">
          <h3 class="mb-4 text-center">
            <i class="bi bi-person-badge"></i> Información del Alumno
          </h3>
          
          <div class="row">
            <div class="col-md-6">
              <div class="detail-item">
                <h5 class="detail-label"><i class="bi bi-card-heading"></i> Número de Control</h5>
                <p class="detail-value">{{ $alumno->Num_Control }}</p>
              </div>
              
              <div class="detail-item">
                <h5 class="detail-label"><i class="bi bi-person"></i> Nombre</h5>
                <p class="detail-value">{{ $alumno->Nombre }}</p>
              </div>
              
              <div class="detail-item">
                <h5 class="detail-label"><i class="bi bi-person"></i> Primer Apellido</h5>
                <p class="detail-value">{{ $alumno->Primer_Ap }}</p>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="detail-item">
                <h5 class="detail-label"><i class="bi bi-person"></i> Segundo Apellido</h5>
                <p class="detail-value">{{ $alumno->Segundo_Ap }}</p>
              </div>
              
              <div class="detail-item">
                <h5 class="detail-label"><i class="bi bi-calendar"></i> Fecha de Nacimiento</h5>
                <p class="detail-value">{{ date('d/m/Y', strtotime($alumno->Fecha_Nac)) }}</p>
              </div>
              
              <div class="detail-item">
                <h5 class="detail-label"><i class="bi bi-mortarboard"></i> Semestre</h5>
                <p class="detail-value">{{ $alumno->Semestre }}</p>
              </div>
              
              <div class="detail-item">
                <h5 class="detail-label"><i class="bi bi-book"></i> Carrera</h5>
                <p class="detail-value">{{ $alumno->Carrera }}</p>
              </div>
            </div>
          </div>
          
          <div class="text-center mt-4">
            <a href="/alumnos" class="btn btn-outline-secondary">
              <i class="bi bi-arrow-left"></i> Volver al listado
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="footer mt-auto py-3 bg-light">
    <div class="container text-center">
      <span class="text-muted">© 2023 Servicios Escolares</span>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>