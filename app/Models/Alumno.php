<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
    
class Alumno extends Model{
    use HasFactory;

    protected $fillable = [
        'Num_Control',
        'Nombre',
        'Primer_Ap',
        'Segundo_Ap',
        'Fecha_Nac',
        'Semestre',
        'Carrera',
    ];
    public $timestamps = false;

}
