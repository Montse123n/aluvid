@extends('layouts.admin')

@section('content')
<div class="container my-4">
    <h1 class="text-center mb-4 display-5">Tipos de Productos para el Sector: <span class="text-primary">{{ $sector->nombre }}</span></h1>
    
    <!-- Botón de Regresar -->
    <div class="d-flex justify-content-start mb-4">
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">← Regresar</a>
    </div>

    <!-- Formulario de búsqueda -->
    <form action="{{ route('admin.showTipos', ['sectorId' => $sector->id]) }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Buscar tipos de producto..." value="{{ $search ?? '' }}">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </div>
    </form>

    <!-- Listado de tipos de productos -->
    @if($tipos->isEmpty())
        <p class="text-center text-muted">No hay tipos de productos para este sector.</p>
    @else
        <div class="row">
            @foreach($tipos as $tipo)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100 transition-card">
                        <div class="card-body d-flex flex-column text-center">
                            <h5 class="card-title font-weight-bold">{{ $tipo->nombre }}</h5>
                            <p class="card-text text-muted">{{ $tipo->descripcion ?? 'Descripción no disponible.' }}</p>
                            <a href="{{ route('admin.showProductos', ['tipoId' => $tipo->id]) }}" class="btn btn-outline-primary mt-auto">Ver Productos</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Botón para agregar un nuevo tipo -->
    <div class="text-center mt-4">
        <a href="{{ route('admin.createTipo', ['sectorId' => $sector->id]) }}" class="btn btn-success btn-lg">Agregar Tipo de Producto</a>
    </div>
</div>

<style>
    .transition-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .transition-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
    }
    .card-title {
        color: #2c3e50;
        font-size: 1.25rem;
        font-weight: 600;
    }
</style>
@endsection
