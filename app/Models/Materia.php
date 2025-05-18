<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Materia extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'carrera', 'semestre'];

    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class, 'alumno_materia', 'materia_id', 'alumno_id')
            ->withPivot('semestre', 'calificacion')
            ->withTimestamps();
    }
    

    public function calificaciones()
    {
        return $this->hasMany(Calificacion::class);
    }
}
