@extends('adminlte::page')

@section('content')
<div class="container mt-4">
    <br><br>
    <div class="card">
        <div class="card-header">
            <h4>Cambiar Contraseña</h4>
        </div>
        <div class="card-body">
            {{-- Errores generales --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Mensaje de éxito --}}
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form action="/password_change" method="POST">
                @csrf
                @method('PUT')

                {{-- Contraseña actual --}}
                <div class="mb-3">
                    <label for="current_password" class="form-label">Contraseña Actual</label>
                    <div class="input-group">
                        <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" required>
                        <button type="button" class="btn btn-outline-secondary toggle-password" data-target="current_password">👁</button>
                    </div>
                    @error('current_password')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Nueva contraseña --}}
                <div class="mb-3">
                    <label for="new_password" class="form-label">Nueva Contraseña</label>
                    <div class="input-group">
                        <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" required>
                        <button type="button" class="btn btn-outline-secondary toggle-password" data-target="new_password">👁</button>
                    </div>
                    @error('new_password')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Confirmar nueva contraseña --}}
                <div class="mb-3">
                    <label for="new_password_confirmation" class="form-label">Confirmar Nueva Contraseña</label>
                    <div class="input-group">
                        <input type="password" name="new_password_confirmation" class="form-control" id="new_password_confirmation" required>
                        <button type="button" class="btn btn-outline-secondary toggle-password" data-target="new_password_confirmation">👁</button>
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Guardar Cambios</button>
                <a href="/alumnos" class="btn btn-danger">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    // Función para mostrar/ocultar contraseñas
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function () {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            if (input.type === "password") {
                input.type = "text";
                this.textContent = "🙈";
            } else {
                input.type = "password";
                this.textContent = "👁";
            }
        });
    });
</script>
@endsection
