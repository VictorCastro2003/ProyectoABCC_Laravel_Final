<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
  <link href="{{ asset('css/loginStyle.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="auth-container">
        <!-- Session Status -->
        <div class="session-status session-status-success">
            <?php
            $status = session('status');
            if ($status) {
                echo htmlspecialchars($status);
            }
            ?>
        </div>

        <h1 class="auth-title">Iniciar Sesión</h1>
        
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Username -->
            <div class="input-group">
                <label for="name" class="input-label">Nombre de Usuario</label>
                <input id="name" class="text-input" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="username">
                @if ($errors->has('name'))
                    <div class="input-error">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>

            <!-- Password -->
            <div class="input-group">
                <label for="password" class="input-label">Contraseña</label>
                <input id="password" class="text-input" type="password" name="password" required autocomplete="current-password">
                @if ($errors->has('password'))
                    <div class="input-error">
                        {{ $errors->first('password') }}
                    </div>
                @endif
            </div>

            <!-- Remember Me -->
            <div class="remember-me">
                <input id="remember_me" type="checkbox" name="remember">
                <label for="remember_me">Recordar sesión</label>
            </div>

            <!-- Campo oculto para reCAPTCHA -->
            <input type="hidden" name="recaptcha_token" id="recaptcha_token">

            <div class="auth-footer">
                @if (Route::has('password.request'))
                    <a class="forgot-password" href="{{ route('password.request') }}">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif

                <button type="submit" class="primary-button">
                    Iniciar Sesión
                </button>
            </div>
        </form>
    </div>

    <!-- reCAPTCHA v3 -->
    <script src="https://www.google.com/recaptcha/api.js?render={{ env('RECAPTCHA_SITE_KEY') }}"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('{{ env('RECAPTCHA_SITE_KEY') }}', {action: 'login'}).then(function(token) {
                document.getElementById('recaptcha_token').value = token;
            });
        });
    </script>
    <script>
   <script>
// Refrescar tokens cada 2 minutos (más frecuente para Render)
function refreshTokens() {
    fetch('/sanctum/csrf-cookie', {
        method: 'GET',
        credentials: 'include',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    }).then(() => {
        console.log('Tokens actualizados');
        // Actualizar reCAPTCHA
        if (typeof grecaptcha !== 'undefined') {
            grecaptcha.ready(() => {
                grecaptcha.execute('{{ env('RECAPTCHA_SITE_KEY') }}', {action: 'login'})
                    .then(token => {
                        document.getElementById('recaptcha_token').value = token;
                    });
            });
        }
    });
}

// Ejecutar inmediatamente y cada 2 minutos
refreshTokens();
setInterval(refreshTokens, 2 * 60 * 1000);

// Forzar recarga si se detecta error CSRF
window.addEventListener('load', function() {
    if (typeof document.querySelector('.input-error') !== 'undefined') {
        refreshTokens();
    }
});
</script>
</body>
</html>
