@extends('layouts.admin')

@section('content')
<div class="container my-5">
    <h1 class="text-center text-primary mb-4">Productos del Tipo: {{ $tipo->nombre }}</h1>

    <!-- Mostrar mensaje de éxito -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Mostrar mensaje de error -->
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Botón para agregar nuevo producto -->
    <div class="text-end mb-4">
        <a href="{{ route('admin.createProducto', $tipo->id) }}" class="btn btn-success">Agregar Producto</a>
    </div>

    <!-- Lista de productos -->
    <div class="row">
        @foreach($productos as $producto)
            <div class="col-md-12 mb-4">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <!-- Producto Principal -->
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('storage/' . $producto->imagen_url) }}" 
                                 alt="{{ $producto->nombre }}" 
                                 class="img-thumbnail me-3" 
                                 style="height: 100px; width: 100px; object-fit: cover;">
                            <div>
                                <h5 class="card-title text-dark mb-1">{{ $producto->nombre }}</h5>
                                <p class="text-muted mb-2">{{ $producto->descripcion }}</p>
                                <!-- Mostrar precio solo para el sector "Vidrios" -->
                                @if($tipo->sector->nombre === 'Vidrios')
                                    <p class="fw-bold text-primary">Precio: ${{ number_format($producto->precio, 2) }}</p>
                                @endif
                                <!-- Botones de acciones -->
                                <a href="{{ route('admin.editProducto', $producto->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('admin.destroyProducto', $producto->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Subproductos en lista -->
                    @if($producto->subproductos->isNotEmpty())
                        <div class="card-body border-top">
                            <h6 class="text-secondary">Subproductos de {{ $producto->nombre }}</h6>
                            <ul class="list-group">
                                @foreach($producto->subproductos as $subproducto)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('storage/' . $subproducto->imagen_url) }}" 
                                                 alt="{{ $subproducto->nombre }}" 
                                                 class="img-thumbnail me-3" 
                                                 style="height: 50px; width: 50px; object-fit: cover;">
                                            <div>
                                                <h6 class="mb-0 text-dark">{{ $subproducto->nombre }}</h6>
                                                <small class="text-muted">{{ $subproducto->descripcion }}</small>
                                                <!-- Mostrar precio de subproductos -->
                                                @if($tipo->sector->nombre !== 'Vidrios')
                                                    <p class="mb-0 text-primary">Precio: ${{ number_format($subproducto->precio, 2) }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- Botones de acciones -->
                                        <div>
                                            <a href="{{ route('admin.editSubproducto', $subproducto->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                            <form action="{{ route('admin.destroySubproducto', $subproducto->id) }}" method="POST" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                                            </form>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Botón para agregar subproducto -->
                    @if($tipo->sector->nombre === 'Aluminio' || $tipo->sector->nombre === 'Herrajes')
                        <div class="card-footer text-end">
                            <a href="{{ route('admin.createSubproducto', $producto->id) }}" class="btn btn-primary btn-sm">Agregar Subproducto</a>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
