@extends('adminlte::page')

@section('content')
<div class="container mt-4">
    <h2>Registrar Calificaciones para {{ $alumno->Nombre }}</h2>

    @php
        $materiasPorSemestre = $materiasAsignadas->groupBy('pivot.semestre');
        $ultimoSemestre = $materiasPorSemestre->keys()->max();
    @endphp

    <div x-data="{ tab: '{{ $ultimoSemestre }}', verTodo: false }">

        {{-- Botón para cambiar modo --}}
        <div class="mb-3 d-flex justify-content-end">
            <button class="btn btn-outline-primary" @click="verTodo = !verTodo">
                <i class="fas fa-layer-group"></i>
                <span x-text="verTodo ? 'Ver por pestañas' : 'Ver todo junto'"></span>
            </button>
        </div>

        {{-- Pestañas (solo si NO está en modo ver todo) --}}
        <template x-if="!verTodo">
            <ul class="nav nav-tabs nav-fill mb-3 border rounded shadow-sm bg-white">
                @foreach($materiasPorSemestre->keys() as $sem)
                    <li class="nav-item">
                        <a href="#" class="nav-link fw-semibold"
                           :class="{ 'active bg-success text-white': tab === '{{ $sem }}' }"
                           @click.prevent="tab = '{{ $sem }}'">
                            Semestre {{ $sem }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </template>

        {{-- Formulario de calificaciones --}}
        <form method="POST" action="{{ route('calificaciones.store', $alumno->id) }}">
            @csrf

            @foreach($materiasPorSemestre as $semestre => $materias)
                <div x-show="verTodo || tab === '{{ $semestre }}'" x-transition>
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
</div>
@endsection

@section('js')

@endsection
