<!DOCTYPE html>
<html lang="es">
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>

<head>
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
<script>
    grecaptcha.ready(function () {
        grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', {action: 'submit'}).then(function (token) {
            let input = document.createElement('input');
            input.setAttribute('type', 'hidden');
            input.setAttribute('name', 'g-recaptcha-response');
            input.setAttribute('value', token);
            document.forms[0].appendChild(input);
        });
    });
</script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <style>
        :root {
            --primary-color: #6366f1;
            --primary-hover: #4f46e5;
            --text-color: #374151;
            --light-gray: #f3f4f6;
            --border-color: #d1d5db;
            --error-color: #ef4444;
            --success-color: #10b981;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-gray);
            color: var(--text-color);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        
        .auth-container {
            width: 100%;
            max-width: 28rem;
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin: 1rem;
        }
        
        .auth-title {
            font-size: 1.5rem;
            font-weight: 600;
            text-align: center;
            margin-bottom: 1.5rem;
            color: var(--text-color);
        }
        
        .input-group {
            margin-bottom: 1rem;
        }
        
        .input-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--text-color);
        }
        
        .text-input {
            width: 100%;
            padding: 0.5rem 0.75rem;
            border: 1px solid var(--border-color);
            border-radius: 0.375rem;
            font-size: 1rem;
            line-height: 1.5;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        
        .text-input:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }
        
        .input-error {
            margin-top: 0.5rem;
            color: var(--error-color);
            font-size: 0.875rem;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
            margin-top: 1rem;
        }
        
        .remember-me input {
            width: 1rem;
            height: 1rem;
            border-radius: 0.25rem;
            border: 1px solid var(--border-color);
            margin-right: 0.5rem;
        }
        
        .remember-me input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .remember-me label {
            font-size: 0.875rem;
            color: var(--text-color);
        }
        
        .auth-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.5rem;
        }
        
        .forgot-password {
            color: var(--text-color);
            font-size: 0.875rem;
            text-decoration: underline;
        }
        
        .forgot-password:hover {
            color: var(--primary-color);
        }
        
        .primary-button {
            background-color: var(--primary-color);
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 0.375rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.15s ease-in-out;
        }
        
        .primary-button:hover {
            background-color: var(--primary-hover);
        }
        
        .session-status {
            padding: 0.75rem 1rem;
            margin-bottom: 1rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
        }
        
        .session-status-success {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
            border: 1px solid rgba(16, 185, 129, 0.2);
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
    grecaptcha.ready(function () {
        grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', {action: 'submit'}).then(function (token) {
            let input = document.createElement('input');
            input.setAttribute('type', 'hidden');
            input.setAttribute('name', 'g-recaptcha-response');
            input.setAttribute('value', token);
            document.forms[0].appendChild(input);
        });
    });
</script>
</head>
<body>
    <div class="auth-container">
        <!-- Session Status -->
       @if (session('status'))
    <div class="session-status session-status-success">
        {{ session('status') }}
    </div>
@endif

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
</body>
</html>
