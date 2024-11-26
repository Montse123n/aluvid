@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center text-primary mb-4">Productos de {{ $tipo->nombre }}</h1>

    @if($productos->isEmpty())
        <p class="text-muted text-center">No hay productos disponibles en este tipo.</p>
    @else
        <div class="row">
            @foreach($productos as $producto)
                <div class="col-md-4 mb-4">
                    <!-- Contenedor del producto -->
                    <div class="card shadow-sm h-100" style="border-radius: 12px; overflow: hidden;">
                        <!-- Imagen del producto -->
                        @if($producto->imagen_url)
                            <img src="{{ asset('storage/' . $producto->imagen_url) }}" 
                                 alt="{{ $producto->nombre }}" 
                                 class="card-img-top" 
                                 style="height: 200px; object-fit: cover;">
                        @endif

                        <div class="card-body">
                            <h5 class="card-title text-dark fw-bold">{{ $producto->nombre }}</h5>
                            <p class="card-text text-muted">{{ $producto->descripcion }}</p>

                            <!-- Mostrar precio solo para Vidrios -->
                            @if($tipo->sector->nombre == 'Vidrios')
                                <p class="fw-bold text-primary">Precio: ${{ number_format($producto->precio, 2) }}</p>
                            @endif
                        </div>

                        <!-- Subproductos dentro del mismo contenedor -->
                       <!-- Subproductos dentro del mismo contenedor -->
@if(isset($producto->subproductos) && $producto->subproductos->isNotEmpty())
    <div class="card-footer bg-light">
        <h6 class="text-primary fw-bold mb-3">Subproductos</h6>
        <ul class="list-group list-group-flush">
            @foreach($producto->subproductos as $subproducto)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        @if($subproducto->imagen_url)
                            <img src="{{ asset('storage/' . $subproducto->imagen_url) }}" 
                                 alt="{{ $subproducto->nombre }}" 
                                 class="img-thumbnail me-3" 
                                 style="height: 50px; width: 50px; object-fit: cover;">
                        @else
                            <img src="{{ asset('default-placeholder.png') }}" 
                                 alt="Sin imagen" 
                                 class="img-thumbnail me-3" 
                                 style="height: 50px; width: 50px; object-fit: cover;">
                        @endif
                        <span>
                            <strong>{{ $subproducto->nombre }}</strong>
                            <p class="mb-0 text-muted small">{{ $subproducto->descripcion }}</p>
                        </span>
                    </div>
                    <span class="fw-bold text-primary">
                        ${{ number_format($subproducto->precio, 2) }}
                    </span>
                </li>
            @endforeach
        </ul>
    </div>
@endif

                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<style>
    /* Estilos personalizados */
    .card {
        border: none;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        font-size: 1.25rem;
    }

    .card-img-top {
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }

    .list-group-item {
        border: none;
    }

    .list-group-item:not(:last-child) {
        border-bottom: 1px solid #ddd;
    }
</style>
@endsection
