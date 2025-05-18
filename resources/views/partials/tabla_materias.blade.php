@if($materiasFiltradas->count() > 0)
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th>Materia</th>
                    <th>Semestre (Materia)</th>
                    <th>Calificación</th>
                </tr>
            </thead>
            <tbody>
                @foreach($materiasFiltradas as $materia)
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
    <p class="text-center text-muted">No hay materias asignadas en este semestre.</p>
@endif
