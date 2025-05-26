@extends('adminlte::page')

@section('title', 'Mi Perfil')

@section('content_header')
    <h1>Mi Perfil</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body d-flex flex-column align-items-center text-center">
        {{-- Icono de usuario --}}
        <div class="mb-3">
            <i class="fas fa-user-circle fa-5x text-secondary"></i>
        </div>

        {{-- Información del usuario --}}
        <h4 class="mb-2">Nombre de usuario: <strong>{{ auth()->user()->name }}</strong></h4>

        {{-- Rol (si aplica) --}}
        <p class="text-muted">Rol: Administrador</p>


        <div class="d-flex gap-3 mt-3">
            <a href="{{ route('password.change') }}" class="btn btn-outline-primary">
                <i class="fas fa-lock"></i> Cambiar Contraseña
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-outline-danger">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </button>
            </form>
        </div>
    </div>
</div>
@stop
