@extends('adminlte::page')

@section('content')
<div class="container mt-4">
    <h2>Registrar Calificaciones para {{ $alumno->Nombre }}</h2>

    <form method="POST" action="{{ route('calificaciones.store', $alumno->id) }}">
        @csrf
        @foreach($materiasAsignadas as $materia)
            <div class="mb-3">
                <label>{{ $materia->nombre }} (Semestre {{ $materia->semestre }})</label>

                @php
                    $calificacion = $materia->pivot->calificacion;
                @endphp

                @if(!is_null($calificacion))
                    <input type="text" value="{{ $calificacion }}" class="form-control" disabled>
                @else
                    <input type="number" name="calificaciones[{{ $materia->id }}]" class="form-control"
                           required min="0" max="100" step="0.01">
                @endif
            </div>
        @endforeach

        <button class="btn btn-success">Guardar Calificaciones</button>
    </form>
</div>
@endsection
