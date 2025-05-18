@extends('adminlte::page')

@section('title', 'Detalle del Alumno')

@section('content_header')
    <h1>Detalle del Alumno</h1>
@stop


@section('content')
<div class="container mt-4">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@php
    $reprobadas = optional($alumno->materias)->filter(function ($materia) {
        return $materia->pivot->calificacion !== null && $materia->pivot->calificacion < 70;
    })->count() ?? 0;

    $status = $reprobadas >= 2 ? 'En riesgo' : 'Regular';
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
            <div class="col-md-4">
                <strong>Fecha de Nacimiento:</strong>
                {{ \Carbon\Carbon::parse($alumno->Fecha_Nac)->format('d/m/Y') }}
            </div>
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

    {{-- Materias y Calificaciones --}}
    <x-adminlte-card title="Materias Asignadas y Calificaciones" theme="teal" icon="fas fa-list">
        @if($alumno->materias && $alumno->materias->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th>Materia</th>
                            <th>Semestre</th>
                            <th>Calificación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alumno->materias as $materia)
                            <tr>
                                <td>{{ $materia->nombre }}</td>
                                <td>{{ $materia->semestre }}</td>
                                <td>{{ $materia->pivot->calificacion ?? 'No asignada' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-center text-muted">Este alumno aún no tiene materias asignadas.</p>
        @endif
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
@stop
