<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class Alumno extends Model{
    use HasFactory;
    use SoftDeletes;
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
    protected $dates = ['deleted_at'];
      public function materias()
    {
        return $this->belongsToMany(Materia::class, 'alumno_materia', 'alumno_id', 'materia_id')
                    ->withPivot('calificacion')
                    ->withTimestamps();
    }
}
