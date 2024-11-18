@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center text-primary">Productos en {{ $tipo->nombre }}</h1>
    <div class="row">
        @foreach($tipo->productos as $producto)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ asset('storage/' . $producto->imagen_url) }}" class="card-img-top" alt="{{ $producto->nombre }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $producto->nombre }}</h5>
                        <p>{{ $producto->descripcion }}</p>
                        <p class="text-success fw-bold">Precio: ${{ $producto->precio }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
