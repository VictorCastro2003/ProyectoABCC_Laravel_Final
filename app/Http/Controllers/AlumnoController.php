<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; // Importación de Session

class AlumnoController extends Controller
{
    // -------- ALTAS --------
    public function create()
    {
        return view('insertar');
    }
    public function store(Request $request)
    {
        $request->validate([
            'Num_Control' => 'required|unique:alumnos,Num_Control',
            'Nombre' => 'required',
            'Primer_Ap' => 'required',
            // puedes validar más campos si quieres
        ]);
    
        Alumno::create($request->all());
    
        return redirect()->route('alumnos.index')->with('exito', 'Agregado Correctamente!');
    }
    

    // -------- BAJAS --------
    public function destroy(Alumno $alumno)
    {
        $alumno->delete();
        return redirect()->route('alumnos.index')->with('exito', 'Eliminado Correctamente!!!!!');
    }

    // -------- CAMBIOS --------
    public function edit(Alumno $alumno)
    {
        return view('editar', compact('alumno'));
    }

    public function update(Request $request, $id)
    {
        $alumno = Alumno::find($id);

        $alumno->Num_Control = $request->input('Num_Control');
        $alumno->Nombre = $request->input('Nombre');
        $alumno->Primer_Ap = $request->input('Primer_Ap');
        $alumno->Segundo_Ap = $request->input('Segundo_Ap');
        $alumno->Fecha_Nac = $request->input('Fecha_Nac');
        $alumno->Semestre = $request->input('Semestre');
        $alumno->Carrera = $request->input('Carrera');

        $alumno->save();
        Session::flash('message', 'MODIFICADO Correctamente !'); // Aquí estaba el error
        return redirect()->route('alumnos.index');
    }

    // -------- CONSULTAS --------
    public function index()
    {
        $alumnos = Alumno::latest()->paginate(5);
        return view('index', compact('alumnos'));
    }

    public function show($num_control)
    {
        $alumno = Alumno::where('Num_Control', $num_control)->firstOrFail();
        return view('detalle', compact('alumno'));
    }
}
