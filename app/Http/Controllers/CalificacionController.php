<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;

class CalificacionController extends Controller
{
    public function create(Alumno $alumno)
    {
        // Traer materias asignadas con la calificación directamente desde la tabla pivote
        $materiasAsignadas = $alumno->materias;

        return view('calificaciones', compact('alumno', 'materiasAsignadas'));
    }

    public function store(Request $request, Alumno $alumno)
    {
        $request->validate([
            'calificaciones' => 'required|array',
            'calificaciones.*' => 'required|numeric|min:0|max:100',
        ]);

        foreach ($request->calificaciones as $materiaId => $nota) {
            $alumno->materias()->updateExistingPivot($materiaId, [
                'calificacion' => $nota,
            ]);
        }

        return redirect()->route('alumnos.show', $alumno->Num_Control)
    ->with('success', 'Calificaciones registradas correctamente.');
    }
}
