<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Illuminate\Session\TokenMismatchException;
use App\Providers\RouteServiceProvider;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
   public function store(Request $request): RedirectResponse
{
    try {  // <-- Agrega el try aquí
        $request->validate([
            'name' => ['required', 'string'],
            'password' => ['required', 'string'],
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
            throw ValidationException::withMessages([
                'name' => 'Falló la verificación de seguridad (reCAPTCHA). Inténtalo de nuevo.',
            ]);
        }

        if (! Auth::attempt($request->only('name', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'name' => __('auth.failed'),
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);

    } catch (\Illuminate\Session\TokenMismatchException $e) {  // <-- Agrega el catch aquí
        return back()->withErrors([
            'name' => 'La sesión expiró por inactividad. Por favor, recarga la página e intenta nuevamente.',
        ]);
    }
}

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function username()
{
    return 'name';
}
}
