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
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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

          <script>
            function formularioAlumno() {
                return {
                    numControl: '{{ $alumno->Num_Control }}',
                    nombre: '{{ $alumno->Nombre }}',
                    primerAp: '{{ $alumno->Primer_Ap }}',
                    segundoAp: '{{ $alumno->Segundo_Ap }}',
                    fechaNac: '{{ $alumno->Fecha_Nac }}',
                    semestre: '{{ $alumno->Semestre }}',
                    carrera: '{{ $alumno->Carrera }}',
                    existe: false,
                    originalNumControl: '{{ $alumno->Num_Control }}',
                    
                    async verificar() {
                        if (this.numControl === this.originalNumControl) {
                            this.existe = false;
                            return;
                        }
                        
                        if (!this.numControl.match(/^[A-Za-z]?\d{8}$/)) {
                            this.existe = false;
                            return;
                        }
                        const response = await fetch(`/verificar-num-control/${this.numControl}`);
                        const data = await response.json();
                        this.existe = data.existe;
                    },
                    
                    limpiarTexto(campo) {
                        if (campo === 'nombre') {
                            this[campo] = this[campo].replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '');
                        } else if (campo === 'semestre') {
                            this[campo] = this[campo].replace(/[^\d]/g, '');
                            if (this[campo] > 12) this[campo] = 12;
                            if (this[campo] < 1) this[campo] = 1;
                        } else {
                            this[campo] = this[campo].replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ]/g, '');
                        }
                    },
                  
                    
                    confirmarEnvio() {
                        if (this.todoValido) {
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
                                    this.$el.submit();
                                }
                            });
                        }
                    }
                }
            }
          </script>

          <form id="formulario" method="POST" action="{{ route('alumnos.update', $alumno->id) }}" role="form" 
                enctype="multipart/form-data" x-data="formularioAlumno()" x-init="verificar()" @submit.prevent="confirmarEnvio">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="mb-3">
              <label for="Num_Control" class="form-label">Número de Control</label>
              <input class="form-control" name="Num_Control" type="text" id="Num_Control" 
                     x-model="numControl" @input="verificar()" required>
              <template x-if="existe">
                  <small class="text-danger">Este número de control ya está registrado por otro alumno.</small>
              </template>
            </div>

            <div class="mb-3">
              <label for="Nombre" class="form-label">Nombre</label>
              <input class="form-control" name="Nombre" type="text" id="Nombre" 
                     x-model="nombre" @input="limpiarTexto('nombre')" required>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="Primer_Ap" class="form-label">Primer Apellido</label>
                <input class="form-control" name="Primer_Ap" type="text" id="Primer_Ap" 
                       x-model="primerAp" @input="limpiarTexto('primerAp')" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="Segundo_Ap" class="form-label">Segundo Apellido</label>
                <input class="form-control" name="Segundo_Ap" type="text" id="Segundo_Ap" 
                       x-model="segundoAp" @input="limpiarTexto('segundoAp')" required>
              </div>
            </div>

            <div class="mb-3">
              <label for="Fecha_Nac" class="form-label">Fecha de Nacimiento</label>
              <input class="form-control" name="Fecha_Nac" type="date" id="Fecha_Nac" 
                     x-model="fechaNac" required>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="Semestre" class="form-label">Semestre</label>
                <input class="form-control" name="Semestre" type="number" id="Semestre" 
                       x-model="semestre" @input="limpiarTexto('semestre')" min="1" max="12" required>
              </div>

              <div class="col-md-6 mb-3">
                <label for="Carrera" class="form-label">Carrera</label>
                <select name="Carrera" id="Carrera" class="form-select" x-model="carrera" required>
                  <option value="" disabled>Selecciona una carrera...</option>
                  <option value="Ingeniería en Sistemas">Ingeniería en Sistemas</option>
                  <option value="Administración de Empresas">Administración de Empresas</option>
                  <option value="Contaduría">Contaduría</option>
                  <option value="Ingeniería Mecatrónica">Ingeniería Mecatrónica</option>
                  <option value="Otra...">Otra...</option>
                </select>
              </div>
            </div>

            <div class="text-center">
              <button type="submit" class="btn btn-success w-50" >Guardar</button>
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


  </style>
</body>
</html>
