@extends('adminlte::page')

@section('content')
<div class="container mt-4">
    <h2>Registrar Calificaciones para {{ $alumno->Nombre }}</h2>

    @php
        $materiasPorSemestre = $materiasAsignadas->groupBy('pivot.semestre');
        $ultimoSemestre = $materiasPorSemestre->keys()->max();
    @endphp

    {{-- Dropdown para seleccionar semestre --}}
    <div class="mb-3">
        <label for="semestreSelector" class="form-label">Seleccionar Semestre</label>
        <select id="semestreSelector" class="form-select">
            @foreach($materiasPorSemestre->keys() as $semestre)
                <option value="{{ $semestre }}" {{ $semestre == $ultimoSemestre ? 'selected' : '' }}>
                    Semestre {{ $semestre }}
                </option>
            @endforeach
        </select>
    </div>

    <form method="POST" action="{{ route('calificaciones.store', $alumno->id) }}">
        @csrf

        @foreach($materiasPorSemestre as $semestre => $materias)
            <div class="semestre-form" data-semestre="{{ $semestre }}" style="{{ $semestre == $ultimoSemestre ? '' : 'display:none;' }}">
                <h4 class="mt-4">Semestre {{ $semestre }}</h4>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Materia</th>
                                <th>Calificación</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($materias as $materia)
                                <tr>
                                    <td>{{ $materia->nombre }}</td>
                                    <td>
                                        <input
                                            type="number"
                                            name="calificaciones[{{ $materia->id }}]"
                                            class="form-control"
                                            value="{{ old("calificaciones.{$materia->id}", $materia->pivot->calificacion) }}"
                                            min="0"
                                            max="100"
                                            step="0.01"
                                            required
                                        >
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach

        <button class="btn btn-success mt-4">Guardar Calificaciones</button>
    </form>
</div>
@endsection

@section('js')
<script>
    document.getElementById('semestreSelector').addEventListener('change', function () {
        const selected = this.value;
        document.querySelectorAll('.semestre-form').forEach(div => {
            div.style.display = div.getAttribute('data-semestre') === selected ? '' : 'none';
        });
    });
</script>
@endsection
