<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Http;

use App\Providers\RouteServiceProvider;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'recaptcha_token' => ['required', 'string'],
        ]);
    
        // Validar reCAPTCHA con la API de Google
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $request->recaptcha_token,
            'remoteip' => $request->ip(),
        ]);
    
        $recaptchaData = $response->json();
    
        if (!($recaptchaData['success'] ?? false) || ($recaptchaData['score'] ?? 0) < 0.5) {
            return back()->withErrors([
                'name' => 'Falló la verificación de seguridad (reCAPTCHA). Intenta nuevamente.',
            ])->withInput();
        }
    
        $user = User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ]);
    
        Auth::login($user);
    
        return redirect(RouteServiceProvider::HOME);
    }
    

}
