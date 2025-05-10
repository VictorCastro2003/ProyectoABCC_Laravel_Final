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
            'Num_Control' => [
                'required',
                'unique:alumnos,Num_Control',
                'regex:/^\d{8}$/', // exactamente 8 dígitos numéricos
            ],
            'Nombre' => 'required|string|max:255',
            'Primer_Ap' => 'required|string|max:255',
            'Segundo_Ap' => 'nullable|string|max:255',
            'Fecha_Nac' => 'required|date|before:today',
            'Semestre' => 'required|integer|between:1,14',
            'Carrera' => 'required|string|max:255',
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
        $request->validate([
            'Num_Control' => [
                'required',
                'regex:/^\d{8}$/',
                Rule::unique('alumnos', 'Num_Control')->ignore($id),
            ],
            'Nombre' => 'required|string|max:255',
            'Primer_Ap' => 'required|string|max:255',
            'Segundo_Ap' => 'nullable|string|max:255',
            'Fecha_Nac' => 'required|date|before:today',
            'Semestre' => 'required|integer|between:1,14',
            'Carrera' => 'required|string|max:255',
        ]);
    
        $alumno = Alumno::findOrFail($id);
    
        $alumno->update($request->all());
    
        Session::flash('message', 'MODIFICADO Correctamente !');
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
