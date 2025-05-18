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
        'materias' => 'required|array|max:6'
    ]);

    $alumno->materias()->syncWithoutDetaching($request->materias);

    return redirect()->route('alumnos.show', $alumno->Num_Control)
    ->with('success', 'Materias asignadas correctamente.');
}
}
