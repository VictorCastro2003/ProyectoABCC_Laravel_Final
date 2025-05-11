@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard - ALUMNOS</h1>
@stop

@section('content')

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
        <table id="tablaAlumnos" class="table table-striped table-bordered text-center">
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
                        <a href="{{ route('alumnos.edit', $alumno->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('alumnos.destroy', $alumno->id) }}" method="POST" style="display:inline;" class="form-eliminar">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop

@section('css')
    <!-- Estilos de DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@stop

@section('js')
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- jQuery (requerido por DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#tablaAlumnos').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es.json'
                }
            });

            const forms = document.querySelectorAll('.form-eliminar');
            forms.forEach(form => {
                form.addEventListener('submit', function (event) {
                    event.preventDefault();
                    Swal.fire({
                        title: '¿Seguro que quieres eliminar este registro?',
                        text: "Esta acción no se puede deshacer",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>

    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: '{{ session('success') }}',
            confirmButtonColor: '#28a745',
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true
        });
    </script>
    @endif
    @if(session('alumno_eliminado'))
<script>
    let restoreTimeout = setTimeout(() => {
        document.getElementById('undo-form')?.remove();
    }, 15000);

    Swal.fire({
        icon: 'info',
        title: 'Alumno eliminado',
        html: `
            <form id="undo-form" method="POST" action="{{ route('alumnos.restore', session('alumno_eliminado')) }}">
                @csrf
                <button type="submit" class="btn btn-success mt-2">
                    Deshacer eliminación (15s)
                </button>
            </form>
        `,
        showConfirmButton: false,
        timer: 15000,
        timerProgressBar: true
    });
</script>
@endif
@stop
