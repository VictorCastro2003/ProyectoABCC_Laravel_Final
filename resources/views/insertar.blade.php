<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ALTAS</title>
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
        <li class="breadcrumb-item active" aria-current="page">Agregar</li>
      </ol>
    </nav>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="p-4 shadow-lg bg-white rounded">
          <h2 class="mb-4 text-center">NUEVO ALUMNO</h2>

          @if ($errors->any())
            <div class="alert alert-danger" id="error-alert">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>
                    {{ $error == 'The num control has already been taken.' ? 'El número de control ya ha sido registrado.' : $error }}
                  </li>
                @endforeach
              </ul>
            </div>
          @endif

          <script>
            function formularioAlumno() {
                return {
                    numControl: '{{ old('Num_Control') }}',
                    nombre: '{{ old('Nombre') }}',
                    primerAp: '{{ old('Primer_Ap') }}',
                    segundoAp: '{{ old('Segundo_Ap') }}',
                    fechaNac: '{{ old('Fecha_Nac') }}',
                    semestre: '{{ old('Semestre') }}',
                    carrera: '{{ old('Carrera') }}',
                    existe: false,
                    async verificar() {
                        if (!this.numControl.match(/^[A-Za-z]?\d{8}$/)) {
                            this.existe = false;
                            return;
                        }
                        const response = await fetch(`/verificar-num-control/${this.numControl}`);
                        const data = await response.json();
                        this.existe = data.existe;
                    },
                    get todoValido() {
                        return this.numControl && !this.existe &&
                               this.nombre && this.primerAp &&
                               this.fechaNac && this.semestre && this.carrera;
                    },           limpiarTexto(campo) {
    if (campo === 'nombre') {
        // Permitir letras (incluyendo tildes) y espacios
        this[campo] = this[campo].replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '');
    }else if (campo === 'semestre') {
        // Permitir solo números (sin letras ni caracteres especiales)
        this[campo] = this[campo].replace(/[^\d]/g, '');
    } else {
        // Solo letras, sin espacios ni números
        this[campo] = this[campo].replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ]/g, '');
    }
},
                    enviarFormulario() {
                        if (this.todoValido) {
                            this.$el.submit();
                        } else {
                            alert('Por favor, completa todos los campos correctamente.');
                        }
                    }
                }
            }
          </script>

          <form method="POST" action="/alumnos" role="form"
                x-data="formularioAlumno()" x-init="verificar()" @submit.prevent="enviarFormulario">
            @csrf

            <!-- Número de Control -->
            <div class="mb-3">
                <label for="Num_Control" class="form-label">Número de Control</label>
                <input type="text" class="form-control" name="Num_Control" id="Num_Control"
                       x-model="numControl" @input="verificar()"
                       placeholder="Ej. A21070010" required>
                <template x-if="existe">
                    <small class="text-danger">Este número de control ya está registrado.</small>
                </template>
                <template x-if="!existe && numControl.length >= 5">
                    <small class="text-success">Número de control disponible.</small>
                </template>
            </div>

            <!-- Nombre -->
            <div class="mb-3">
                <label for="Nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="Nombre"@input="limpiarTexto('nombre')" id="Nombre"
                       x-model="nombre" placeholder="Ej. Juan" required>
            </div>

            <!-- Apellidos -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="Primer_Ap" class="form-label">Primer Apellido</label>
                    <input type="text" class="form-control" name="Primer_Ap"  @input="limpiarTexto('primerAp')"id="Primer_Ap"
                           x-model="primerAp" placeholder="Ej. Pérez" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="Segundo_Ap" class="form-label">Segundo Apellido</label>
                    <input type="text" class="form-control" name="Segundo_Ap" @input="limpiarTexto('segundoAp')"id="Segundo_Ap"
                           x-model="segundoAp" placeholder="Ej. Gómez">
                </div>
            </div>

            <!-- Fecha de Nacimiento -->
            <div class="mb-3">
                <label for="Fecha_Nac" class="form-label">Fecha de Nacimiento</label>
                <input type="date" class="form-control" name="Fecha_Nac" id="Fecha_Nac"
                       x-model="fechaNac" required>
            </div>

            <!-- Semestre y Carrera -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="Semestre" class="form-label">Semestre</label>
                    <input type="number" class="form-control" name="Semestre" id="Semestre"
                           x-model="semestre" min="1" max="12"@input="limpiarTexto('semestre')" placeholder="Ej. 3" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="Carrera" class="form-label">Carrera</label>
                    <select name="Carrera" id="Carrera" class="form-select" x-model="carrera" required>
                        <option value="" disabled>Selecciona una carrera...</option>
                        <option>Ingeniería en Sistemas</option>
                        <option>Administración de Empresas</option>
                        <option>Contaduría</option>
                        <option>Ingeniería Mecatrónica</option>
                        <option>Otra...</option>
                    </select>
                </div>
            </div>

        

            <!-- Botones -->
            <div class="text-center">
                <button type="submit" class="btn btn-success w-50" >Guardar</button>
                <a href="/alumnos" class="btn btn-warning w-50 mt-2">Cancelar</a>
            </div>
          </form>


          <script>
            document.addEventListener('DOMContentLoaded', function () {
              const alert = document.getElementById('error-alert');
              if (alert) {
                setTimeout(() => {
                  alert.classList.add('fade');
                  alert.classList.add('show');
                  setTimeout(() => {
                    alert.remove();
                  }, 1000);
                }, 5000);
              }
            });

 

          </script>
        </div>
      </div>
    </div>
  </div>

  <footer class="text-muted mt-3 mb-3 text-center">
    FOOTER
  </footer>
</body>
</html>
