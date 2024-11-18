@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center text-primary">Tipos en {{ $sector->nombre }}</h1>
    <div class="row">
        @foreach($sector->tipos as $tipo)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $tipo->nombre }}</h5>
                        <p>{{ $tipo->descripcion }}</p>
                        <a href="{{ route('tipo.productos', ['tipoId' => $tipo->id]) }}" class="btn btn-primary">
                            Ver Productos
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
