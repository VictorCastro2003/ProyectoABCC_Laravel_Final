<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AlumnoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 🌐 Landing page pública
Route::get('/', function () {
    return view('landing'); // Asegúrate de tener esta vista
})->name('landing');

// 🛡️ Rutas protegidas con login
Route::middleware(['auth'])->group(function () {

    // Dashboard generado por Breeze
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

   // 📚 Rutas de Alumnos
Route::get('/alumnos', [AlumnoController::class, 'index'])->name('alumnos.index');
Route::get('/alumnos/create', [AlumnoController::class, 'create'])->name('alumnos.create');
Route::post('/alumnos', [AlumnoController::class, 'store'])->name('alumnos.store');
Route::get('/alumnos/{alumno}/edit', [AlumnoController::class, 'edit'])->name('alumnos.edit');
Route::put('/alumnos/{id}', [AlumnoController::class, 'update'])->name('alumnos.update');
Route::delete('/alumnos/{alumno}', [AlumnoController::class, 'destroy'])->name('alumnos.destroy');
Route::get('/alumnos/{num_control}', [AlumnoController::class, 'show'])->name('alumnos.show');


});

require __DIR__.'/auth.php';
