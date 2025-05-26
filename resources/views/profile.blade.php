@extends('adminlte::page')

@section('title', 'Mi Perfil')

@section('content_header')
    <h1>Mi Perfil</h1>
@stop

@section('content')
<div x-data="{ mostrarDetalles: false, showLogoutModal: false }" class="card">
    <div class="card-body text-center">

        {{-- Icono --}}
        <div class="mb-3">
            <i class="fas fa-user-circle fa-5x text-secondary"></i>
        </div>

        {{-- Nombre de usuario --}}
        <h4 class="mb-1">Nombre de usuario: <strong>{{ auth()->user()->name }}</strong></h4>

        {{-- Botón toggle --}}
        <button @click="mostrarDetalles = !mostrarDetalles" class="btn btn-sm btn-link text-primary">
            <i :class="mostrarDetalles ? 'fas fa-chevron-up' : 'fas fa-chevron-down'"></i>
            Detalles
        </button>

        {{-- Detalles opcionales --}}
        <div x-show="mostrarDetalles" x-transition class="mt-2">
            <p class="text-muted">Rol: Administrador</p>
            {{-- Puedes agregar más detalles aquí --}}
            {{-- <p class="text-muted">Último acceso: {{ auth()->user()->updated_at->diffForHumans() }}</p> --}}
        </div>

        <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="{{ route('password.change') }}" class="btn btn-outline-primary">
                <i class="fas fa-lock"></i> Cambiar Contraseña
            </a>

            {{-- Botón para abrir modal de cierre --}}
            <button @click="showLogoutModal = true" class="btn btn-outline-danger">
                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
            </button>
        </div>

        {{-- Modal de confirmación --}}
        <div x-show="showLogoutModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" x-cloak>
            <div class="bg-white p-4 rounded shadow-lg text-center w-80">
                <h5 class="mb-3">¿Deseas cerrar sesión?</h5>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger me-2">Sí, cerrar sesión</button>
                    <button type="button" @click="showLogoutModal = false" class="btn btn-secondary">Cancelar</button>
                </form>
            </div>
        </div>

    </div>
</div>
@stop
