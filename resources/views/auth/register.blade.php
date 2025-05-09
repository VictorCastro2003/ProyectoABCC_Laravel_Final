<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .register-container {
            max-width: 450px;
            margin: 50px auto;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .register-title {
            text-align: center;
            margin-bottom: 25px;
            color: #2c3e50;
            font-weight: 600;
        }
        .form-label {
            font-weight: 500;
            margin-bottom: 8px;
            color: #495057;
        }
        .form-control {
            height: 45px;
            border-radius: 6px;
            border: 1px solid #ced4da;
            padding: 10px 15px;
            margin-bottom: 15px;
        }
        .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
        .btn-register {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            font-weight: 500;
            background-color: #0d6efd;
            border: none;
            border-radius: 6px;
            margin-top: 10px;
        }
        .btn-register:hover {
            background-color: #0b5ed7;
        }
        .password-hint {
            font-size: 13px;
            color: #6c757d;
            margin-top: -10px;
            margin-bottom: 15px;
        }
        .login-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #6c757d;
        }
        .login-link:hover {
            color: #0d6efd;
            text-decoration: none;
        }
        .invalid-feedback {
            color: #dc3545;
            font-size: 14px;
            margin-top: -10px;
            margin-bottom: 15px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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

</head>
<body>
    <div class="register-container">
        <h2 class="register-title">Registro</h2>
        
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nombre de Usuario -->
            <div>
                <label for="name" class="form-label">Nombre de Usuario</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}"
                    class="form-control @error('name') is-invalid @enderror" 
                    required autofocus autocomplete="username">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Contraseña -->
            <div>
                <label for="password" class="form-label">Contraseña</label>
                <input id="password" type="password" name="password"
                    class="form-control @error('password') is-invalid @enderror" 
                    required autocomplete="new-password">
                <div class="password-hint">Mínimo 8 caracteres</div>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirmar Contraseña -->
            <div>
                <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                <input id="password_confirmation" type="password" name="password_confirmation"
                    class="form-control" required autocomplete="new-password">
            </div>

            <button type="submit" class="btn-register">
                Registrarse
            </button>

            <a class="login-link" href="{{ route('login') }}">
                ¿Ya tienes una cuenta? Inicia sesión
            </a>
        </form>
    </div>
</body>
</html>
