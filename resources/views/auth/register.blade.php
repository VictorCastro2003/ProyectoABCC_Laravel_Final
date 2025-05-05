<x-guest-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h2 class="card-title text-center mb-4">Registro</h2>
                        
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Username -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre de Usuario</label>
                                <input id="name" type="text" name="name" value="{{ old('name') }}"
                                    class="form-control @error('name') is-invalid @enderror" 
                                    required autofocus autocomplete="username">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input id="password" type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" 
                                    required autocomplete="new-password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Mínimo 8 caracteres</div>
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                                <input id="password_confirmation" type="password" name="password_confirmation"
                                    class="form-control" required autocomplete="new-password">
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    Registrarse
                                </button>
                            </div>

                            <div class="text-center">
                                <a class="text-decoration-none" href="{{ route('login') }}">
                                    ¿Ya tienes una cuenta? Inicia sesión
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
