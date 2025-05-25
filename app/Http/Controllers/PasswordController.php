<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PasswordController extends Controller
{
    public function showChangeForm()
    {
        return view('change_password');
    }

    public function update(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();
        $user->password = $request->new_password; // Laravel lo hashea automáticamente por 'cast'
       // dd($request->all());  // Verifica que los datos se envían correctamente
        $user->save();


        return Redirect::route('password.change')->with('status', 'Contraseña actualizada exitosamente.');
    }
}
