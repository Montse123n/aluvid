@extends('layouts.admin')

@section('content')
<div class="container my-4">
    <h1 class="text-center mb-3">Productos en el Tipo: {{ $tipo->nombre }}</h1>
    <div class="mb-3">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Regresar</a>
    </div>

    <!-- Formulario de búsqueda -->
    <form action="{{ route('admin.showProductos', ['tipoId' => $tipo->id]) }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Buscar productos..." value="{{ $search ?? '' }}">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </div>
    </form>
     <!-- Botón para Agregar Producto -->
     <div class="text-center mt-4">
        <a href="{{ route('admin.createProducto', ['tipoId' => $tipo->id]) }}" class="btn btn-success">Agregar Nuevo Producto</a>
    </div>

    <!-- Lista de Productos -->
    <div class="row">
        @foreach ($productos as $producto)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <img src="{{ asset('storage/' . $producto->imagen_url) }}" alt="{{ $producto->nombre }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $producto->nombre }}</h5>
                        <p class="card-text">{{ $producto->descripcion }}</p>
                        <p class="card-text text-primary fw-bold">Precio: ${{ $producto->precio }}</p>
                        <a href="{{ route('admin.editProducto', ['id' => $producto->id]) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('admin.destroyProducto', ['producto' => $producto->id]) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

   
</div>
@endsection
