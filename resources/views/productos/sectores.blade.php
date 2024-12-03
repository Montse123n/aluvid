@extends('layouts.app')

@section('content')
<div class="header-banner mb-5">
    <div class="overlay">
        <div class="text-center">
            <h1 class="text-white fw-bold animated-title">Explora Nuestros Productos</h1>
            <p class="text-white lead mt-3">Calidad y diseño en cada detalle</p>
            <a href="#sectores" class="btn btn-outline-light mt-4 px-5 py-2 animated-button">Descubrir <i class="fas fa-arrow-down"></i></a>
        </div>
    </div>
</div>

<div class="container" id="sectores">
    <div class="row">
        @foreach($sectores as $sector)
            <div class="col-12 mb-4">
                <div class="card overlay-card h-100 border-0" style="border-radius: 15px; overflow: hidden;">
                    <!-- Imagen del sector -->
                    <img src="{{ asset('img/sectores/' . strtolower($sector->nombre) . '.jpg') }}" 
                         class="card-img-top sector-img" 
                         alt="{{ $sector->nombre }}">
                    
                    <!-- Contenido superpuesto -->
                    <div class="overlay-content">
                        <h5 class="card-title text-white fw-bold">{{ $sector->nombre }}</h5>
                        <p class="card-text text-light">{{ $sector->descripcion }}</p>
                        <a href="{{ route('sector.tipos', ['sectorId' => $sector->id]) }}" class="btn btn-outline-light">
                            Ver mas
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
    /* Header banner */
    .header-banner {
        background: url('{{ asset('img/sectores-header.jpg') }}') no-repeat center center/cover;
        height: 400px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .header-banner .overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.6);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        animation: fadeIn 1s ease-out;
    }

    .animated-title {
        font-size: 3.5rem;
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.8);
        animation: slideInDown 1s ease-out;
    }

    .animated-button {
        font-size: 1.2rem;
        border-radius: 30px;
        font-weight: bold;
        transition: transform 0.3s ease, background-color 0.3s ease;
    }

    .animated-button:hover {
        transform: scale(1.1);
        background-color: #ffffff;
        color: #000000;
    }

    /* Animation for header elements */
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* General card styling */
    .overlay-card {
        position: relative;
        overflow: hidden;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        width: 100%;
    }

    .overlay-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }

    /* Styling the image */
    .sector-img {
        width: 100%;
        height: 400px;
        object-fit: cover;
        filter: brightness(0.7);
        transition: transform 0.4s ease, filter 0.4s ease;
    }

    .overlay-card:hover .sector-img {
        transform: scale(1.1);
        filter: brightness(0.5);
    }

    /* Overlay content */
    .overlay-content {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.6);
        color: white;
        padding: 20px;
        text-align: center;
        transition: background 0.4s ease;
    }

    .overlay-content h5 {
        font-size: 2rem;
        margin-bottom: 10px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
    }

    .overlay-content p {
        font-size: 1.2rem;
        margin-bottom: 15px;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.8);
    }

    .overlay-content .btn {
        padding: 12px 25px;
        border-radius: 30px;
        font-size: 1rem;
        transition: background 0.3s ease, transform 0.3s ease;
    }

    .overlay-content .btn:hover {
        background: #ffffff;
        color: #000000;
        transform: translateY(-3px);
    }
</style>
@endsection
