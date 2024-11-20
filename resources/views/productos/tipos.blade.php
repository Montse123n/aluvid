@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center text-primary mb-4">Tipos en {{ $sector->nombre }}</h1>
    
    @if ($sector->tipos->isEmpty())
        <p class="text-center text-muted">No hay tipos disponibles para este sector.</p>
    @else
        <div class="row">
            @foreach($sector->tipos as $tipo)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100 transition-card">
                        <!-- Imagen decorativa del tipo -->
                        <div class="card-img-top bg-light text-center py-5">
                            <i class="bi bi-box-seam text-primary" style="font-size: 3rem;"></i>
                        </div>
                        <!-- Contenido de la tarjeta -->
                        <div class="card-body text-center d-flex flex-column">
                            <h5 class="card-title text-dark font-weight-bold">{{ $tipo->nombre }}</h5>
                            <p class="card-text text-muted">{{ $tipo->Precio }}</p>
                            <a href="{{ route('tipo.productos', ['tipoId' => $tipo->id]) }}" class="btn btn-outline-primary mt-auto">
                                Ver Productos
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

@endsection
