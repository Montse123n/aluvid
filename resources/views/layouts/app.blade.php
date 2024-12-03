<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Aluvid</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --blue-dark: #1a233a;
            --blue-medium: #30577c;
            --blue-light: #6b9ed9;
            --black: #121212;
            --white: #fdfdfd;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--white);
            overflow-x: hidden;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(90deg, var(--blue-dark), var(--blue-medium));
            color: var(--white);
            padding: 10px 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--white);
        }

        .navbar-nav .nav-link {
            color: var(--white);
            font-weight: bold;
            padding: 10px 15px;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: var(--blue-light);
        }

        .navbar-nav .logout-link {
            color: #ff4d4d;
            font-weight: bold;
        }

        .navbar-nav .logout-link:hover {
            color: #ff9999;
        }

        /* Ajuste para el contenido debajo de la barra fija */
        body {
            padding-top: 70px; /* Altura de la barra fija */
        }

        /* Footer */
        .footer {
            background: var(--blue-dark);
            color: var(--white);
            padding: 40px 0;
            text-align: center;
        }

        .footer-links a {
            color: var(--blue-light);
            margin: 0 10px;
            text-decoration: none;
            font-size: 0.95rem;
        }

        .footer-links a:hover {
            color: var(--white);
        }

        .social-icons a {
            color: var(--white);
            margin: 0 10px;
            font-size: 1.5rem;
            transition: color 0.3s;
        }

        .social-icons a:hover {
            color: var(--blue-light);
        }
    </style>
</head>
<body>
    <div id="app">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">ALUVID Ixmiquilpan</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <!-- Enlace a Inicio -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('productos.sectores') }}"><i class="fas fa-home"></i> Inicio</a>
                        </li>
                        <!-- Sectores -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('sector.tipos', ['sectorId' => 1]) }}"><i class="fas fa-gem"></i> Vidrio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('sector.tipos', ['sectorId' => 3]) }}"><i class="fas fa-window-maximize"></i> Aluminio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('sector.tipos', ['sectorId' => 2]) }}"><i class="fas fa-tools"></i> Herrajes</a>
                        </li>
                        <!-- Cerrar Sesión -->
                        <li class="nav-item">
                            <a class="nav-link logout-link" href="{{ route('logout') }}" 
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="py-4">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="footer">
            <div class="footer-links">
                <a  href="{{ route('productos.sectores') }}" >Inicio</a>
                <a  href="{{ route('sector.tipos', ['sectorId' => 1]) }}" >Vidrio</a>
                <a  href="{{ route('sector.tipos', ['sectorId' => 3]) }}" > Aluminio</a>
                <a  href="{{ route('sector.tipos', ['sectorId' => 2]) }}" > Herrajes</a>
            </div>
            <div class="social-icons mt-3">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
            <p class="mt-3">&copy; {{ date('Y') }} Todos los derechos reservados.</p>
        </footer>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
