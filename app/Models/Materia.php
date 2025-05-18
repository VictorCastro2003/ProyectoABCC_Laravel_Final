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
        return $this->belongsToMany(Alumno::class);
    }

    public function calificaciones()
    {
        return $this->hasMany(Calificacion::class);
    }
}
