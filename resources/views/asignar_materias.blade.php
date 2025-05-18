@extends('adminlte::page')

@section('title', 'Asignar Materias')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Asignar materias a {{ $alumno->Nombre }}</h2>

    <form action="{{ route('alumnos.asignarMaterias', $alumno->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="semestre">Selecciona el semestre al que asignarás estas materias</label>
            <input type="number" name="semestre" id="semestre" class="form-control" required min="1" max="12">
        </div>

        @php
            $materiasAsignadas = $alumno->materias->pluck('id')->toArray();
            $materiasDisponibles = $materias->whereNotIn('id', $materiasAsignadas);
        @endphp

        @if($materiasDisponibles->isEmpty())
            <div class="alert alert-info">Todas las materias ya han sido asignadas a este alumno.</div>
        @else
            <div class="row g-3">
                @foreach($materiasDisponibles as $materia)
                    <div class="col-md-6 col-lg-4">
                        <label class="card h-100 shadow-sm border border-light p-3 hover-shadow position-relative">
                            <input type="checkbox" name="materias[]" value="{{ $materia->id }}"
                                   class="form-check-input position-absolute top-0 end-0 m-2">

                            <div class="d-flex align-items-start gap-2">
                                <div class="fs-3 text-primary">
                                    <i class="fas fa-book-open"></i>
                                </div>
                                <div>
                                    <div class="fw-bold">{{ $materia->nombre }}</div>
                                    <span class="badge bg-info text-dark">Semestre {{ $materia->semestre }}</span>
                                </div>
                            </div>
                        </label>
                    </div>
                @endforeach
            </div>

            <button class="btn btn-primary mt-4 px-4">Asignar Materias</button>
        @endif
    </form>
</div>
@endsection


@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('input[name="materias[]"]');
        const max = 6;

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                const checked = document.querySelectorAll('input[name="materias[]"]:checked').length;
                if (checked > max) {
                    this.checked = false;
                    alert('Solo puedes seleccionar hasta 6 materias.');
                }
            });
        });
    });
</script>
@endsection
