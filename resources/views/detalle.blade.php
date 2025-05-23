@extends('adminlte::page')

@section('title', 'Detalle del Alumno')

@section('content_header')
    <h1>Detalle del Alumno</h1>
@stop

@section('content')
<div class="container mt-4">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@php
$ultimoSemestre = $alumno->materias->pluck('pivot.semestre')->unique()->sort()->values()->last();
$reprobadas = $alumno->materias
    ->filter(fn($m) => $m->pivot->semestre == $ultimoSemestre && $m->pivot->calificacion !== null && $m->pivot->calificacion < 70)
    ->count();
$status = $reprobadas >= 2 ? 'En riesgo' : 'Regular';
    $semestres = $alumno->materias->pluck('pivot.semestre')->unique()->sort()->values();
    $ultimoSemestre = $semestres->last();
@endphp

{{-- Información del Alumno --}}
<x-adminlte-card title="Información del Alumno" theme="info" icon="fas fa-user">
    <div class="row mb-2">
        <div class="col-md-4"><strong>Número de Control:</strong> {{ $alumno->Num_Control }}</div>
        <div class="col-md-4"><strong>Nombre:</strong> {{ $alumno->Nombre }}</div>
        <div class="col-md-4"><strong>Primer Apellido:</strong> {{ $alumno->Primer_Ap }}</div>
    </div>
    <div class="row mb-2">
        <div class="col-md-4"><strong>Segundo Apellido:</strong> {{ $alumno->Segundo_Ap }}</div>
        <div class="col-md-4"><strong>Fecha de Nacimiento:</strong> {{ \Carbon\Carbon::parse($alumno->Fecha_Nac)->format('d/m/Y') }}</div>
        <div class="col-md-4"><strong>Semestre:</strong> {{ $alumno->Semestre }}</div>
    </div>
    <div class="row mb-2">
        <div class="col-md-4"><strong>Carrera:</strong> {{ $alumno->Carrera }}</div>
        <div class="col-md-4">
            <strong>Status:</strong>
            @if($status === 'En riesgo')
                <span class="badge bg-danger">En riesgo</span>
            @else
                <span class="badge bg-success">Regular</span>
            @endif
        </div>
    </div>
</x-adminlte-card>

{{-- Filtro por semestre --}}
<div class="row mb-3">
    <div class="col-md-4">
        <label for="semestre_filtrado">Semestre:</label>
        <select name="semestre_filtrado" id="semestre_filtrado" class="form-control">
            @foreach($semestres as $sem)
                <option value="{{ $sem }}" {{ $sem == $ultimoSemestre ? 'selected' : '' }}>{{ $sem }}</option>
            @endforeach
        </select>
    </div>
</div>

{{-- Materias y Calificaciones --}}
<x-adminlte-card title="Materias Asignadas y Calificaciones" theme="teal" icon="fas fa-list">
    <div id="tabla-materias">
        @include('partials.tabla_materias', ['materiasFiltradas' => $alumno->materias->filter(fn($m) => $m->pivot->semestre == $ultimoSemestre)])
    </div>
</x-adminlte-card>

{{-- Acciones --}}
<x-adminlte-card title="Acciones Disponibles" theme="lightblue" icon="fas fa-cogs">
    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('alumnos.asignarMaterias.form', $alumno->id) }}" class="btn btn-outline-primary">
            <i class="fas fa-book"></i> Asignar Materias
        </a>

        <a href="{{ route('calificaciones.create', $alumno->id) }}" class="btn btn-outline-success">
            <i class="fas fa-clipboard-check"></i> Registrar Calificaciones
        </a>

        <a href="{{ route('alumnos.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Volver a Lista
        </a>
    </div>
</x-adminlte-card>
</div>

@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    </script>
@endif

{{-- jQuery y AJAX --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#semestre_filtrado').on('change', function () {
        let semestre = $(this).val();
        let url = "{{ route('alumnos.filtrarMaterias', $alumno->id) }}";

        // Muestra la barra de carga
        $('#tabla-materias').html(`
            <div class="my-3">
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" 
                         role="progressbar" style="width: 100%">
                        Cargando materias...
                    </div>
                </div>
            </div>
        `);

        $.ajax({
            url: url,
            method: 'GET',
            data: { semestre: semestre },
            success: function (response) {
                $('#tabla-materias').html(response.html);
            },
            error: function () {
                $('#tabla-materias').html('<p class="text-danger text-center">Error al cargar las materias.</p>');
            }
        });
    });
</script>

@stop
