<?php

namespace App\Http\Controllers;
use App\Models\Alumno;
use Illuminate\Http\Request;
use App\Models\Materia;

class AlumnoMateriaController extends Controller
{
    public function form(Alumno $alumno)
{
    $materias = Materia::where('carrera', $alumno->Carrera)->get();
    return view('asignar_materias', compact('alumno', 'materias'));
}

 public function asignar(Request $request, Alumno $alumno)
    {
        $request->validate([
            'materias' => 'required|array|max:6',
            'semestre' => 'required|integer|min:1|max:12'
        ]);

        foreach ($request->materias as $materiaId) {
            $alumno->materias()->syncWithoutDetaching([
                $materiaId => ['semestre' => $request->semestre]
            ]);
        }

        return redirect()->route('alumnos.show', $alumno->Num_Control)
            ->with('success', 'Materias asignadas correctamente al semestre especificado.');
    }
    public function filtrarMaterias(Request $request, Alumno $alumno)
{
    $semestreSeleccionado = $request->semestre;
    
    $materiasFiltradas = $alumno->materias->filter(function ($materia) use ($semestreSeleccionado) {
        return !$semestreSeleccionado || $materia->pivot->semestre == $semestreSeleccionado;
    });

    return response()->json([
        'html' => view('partials.tabla_materias', compact('materiasFiltradas'))->render()
    ]);
}
}
