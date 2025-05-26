@extends('adminlte::page')

@section('title', 'Detalle del Alumno')

@section('content_header')
    <h1>Detalle del Alumno</h1>
@stop

@section('content')
<div class="container mt-4">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@php
$semestres = $alumno->materias->pluck('pivot.semestre')->unique()->sort()->values();
$ultimoSemestre = $semestres->last();

// Mapa de estado por semestre
$estadoPorSemestre = [];
foreach ($semestres as $sem) {
    $reprobadasSem = $alumno->materias
        ->filter(fn($m) => $m->pivot->semestre == $sem && $m->pivot->calificacion !== null && $m->pivot->calificacion < 70)
        ->count();
    $estadoPorSemestre[$sem] = $reprobadasSem >= 2 ? 'En riesgo' : 'Regular';
}
$status = $estadoPorSemestre[$ultimoSemestre] ?? 'Regular';
@endphp

{{-- Información del Alumno --}}
<x-adminlte-card id="card-info" title="Información del Alumno" theme="{{ $status === 'En riesgo' ? 'danger' : 'info' }}" icon="fas fa-user">
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
            <span id="estado-actual">
                @if($status === 'En riesgo')
                    <span class="badge bg-danger">En riesgo</span>
                @else
                    <span class="badge bg-success">Regular</span>
                @endif
            </span>
        </div>
    </div>
</x-adminlte-card>

{{-- Materias y Calificaciones --}}
<x-adminlte-card title="Materias por Semestre" theme="teal" icon="fas fa-layer-group" x-data="{ tab: '{{ $ultimoSemestre }}' }">

    @if($semestres->isEmpty())
        <div class="alert alert-warning">
            <i class="fas fa-info-circle"></i> Este alumno aún no tiene materias asignadas.
        </div>
    @else
        {{-- Navegación de pestañas --}}
        <ul class="nav nav-tabs nav-fill mb-3 border rounded shadow-sm bg-white">
            @foreach($semestres as $sem)
                <li class="nav-item">
                    <a href="#" class="nav-link fw-semibold"
                       :class="{ 'active bg-info text-white': tab === '{{ $sem }}' }"
                       @click.prevent="tab = '{{ $sem }}'"
                       data-semestre="{{ $sem }}">
                        Semestre {{ $sem }}
                    </a>
                </li>
            @endforeach
        </ul>

        {{-- Contenido por pestaña --}}
        <div class="tab-content border border-top-0 p-3 bg-light rounded-bottom shadow-sm">
            @foreach($semestres as $sem)
                <div x-show="tab === '{{ $sem }}'" x-transition>
                    @include('partials.tabla_materias', [
                        'materiasFiltradas' => $alumno->materias->filter(fn($m) => $m->pivot->semestre == $sem)
                    ])
                </div>
            @endforeach
        </div>
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

{{-- jQuery y lógica de estado dinámico --}}
<script>
    const estadoPorSemestre = @json($estadoPorSemestre);

    document.querySelectorAll('.nav-link[data-semestre]').forEach(link => {
        link.addEventListener('click', function () {
            const semestreSeleccionado = this.getAttribute('data-semestre');
            const estado = estadoPorSemestre[semestreSeleccionado];

            // Actualiza badge
            const estadoSpan = document.getElementById('estado-actual');
            if (estado === 'En riesgo') {
                estadoSpan.innerHTML = `<span class="badge bg-danger">En riesgo</span>`;
                document.querySelector('#card-info').classList.remove('card-info');
                document.querySelector('#card-info').classList.add('card-danger');
            } else {
                estadoSpan.innerHTML = `<span class="badge bg-success">Regular</span>`;
                document.querySelector('#card-info').classList.remove('card-danger');
                document.querySelector('#card-info').classList.add('card-info');
            }
        });
    });
</script>
@stop
