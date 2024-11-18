@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center text-primary mb-4">Nuestros Sectores</h1>
    <div class="row">
        @foreach($sectores as $sector)
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg h-100 border-0 hover-card" style="border-radius: 12px; overflow: hidden;">
                    <!-- Imagen del sector -->
                    <div class="overflow-hidden">
                        <img src="{{ asset('img/sectores/' . strtolower($sector->nombre) . '.jpg') }}" 
                             class="card-img-top sector-img" 
                             alt="{{ $sector->nombre }}" 
                             style="height: 220px; object-fit: cover;">
                    </div>
                    
                    <div class="card-body text-center" style="background-color: #f8f9fa;">
                        <h5 class="card-title text-primary fw-bold">{{ $sector->nombre }}</h5>
                        <p class="card-text text-muted">{{ $sector->descripcion }}</p>
                        <a href="{{ route('sector.tipos', ['sectorId' => $sector->id]) }}" class="btn btn-primary mt-2 w-75">
                            Ver Tipos
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
    /* Hover effect for the card */
    .hover-card {
        transition: transform 0.4s, box-shadow 0.4s;
    }
    .hover-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
    }

    /* Transition effect for image */
    .sector-img {
        transition: transform 0.4s ease;
    }
    
    /* Image zoom on hover */
    .hover-card:hover .sector-img {
        transform: scale(1.1);
    }
</style>
@endsection
