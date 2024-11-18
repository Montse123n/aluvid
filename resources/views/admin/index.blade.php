@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Administración de Sectores</h1>
    
    <div class="row">
        @foreach ($sectores as $sector)
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm sector-card">
                    <img src="{{ asset('img/sectores/' . strtolower($sector->nombre) . '.jpg') }}" class="card-img-top" alt="{{ $sector->nombre }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ ucfirst($sector->nombre) }}</h5>
                        <p class="card-text">Administrar tipos de productos para el sector de {{ $sector->nombre }}.</p>
                        <a href="{{ route('admin.showTipos', ['sectorId' => $sector->id]) }}" class="btn btn-primary">
                            Ver Tipos de Productos
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
   
</style>
@endsection
