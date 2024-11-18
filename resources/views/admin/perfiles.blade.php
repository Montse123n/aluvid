@if(auth()->user()->role !== 'administrador')
    @php abort(403, 'No tienes permiso para acceder a esta página.'); @endphp
@endif

@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Gestión de Perfiles</h1>
        <!-- Contenido exclusivo para el administrador -->
    </div>
@endsection
