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
        .navbar-custom {
            background: linear-gradient(90deg, var(--blue-dark), var(--blue-medium));
            color: var(--white);
            height: 60px;
            display: flex;
            align-items: center;
            padding: 0 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .navbar-custom .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--white);
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: -300px;
            width: 300px;
            height: 100%;
            background: linear-gradient(180deg, var(--blue-dark), var(--blue-medium));
            color: var(--white);
            box-shadow: 5px 0 15px rgba(0, 0, 0, 0.3);
            transition: all 0.4s ease;
            z-index: 1050;
            display: flex;
            flex-direction: column;
        }

        .sidebar.active {
            left: 0;
        }

        .sidebar .header {
            padding: 20px;
            background-color: var(--blue-dark);
            text-align: center;
        }

        .sidebar .header .user-name {
            font-size: 1.4rem;
            font-weight: bold;
            color: var(--blue-light);
        }

        .sidebar ul {
            list-style: none;
            padding: 20px;
            margin: 0;
            flex: 1;
        }

        .sidebar ul li {
            margin: 15px 0;
        }

        .sidebar ul li a {
            display: flex;
            align-items: center;
            color: var(--white);
            text-decoration: none;
            font-size: 1.1rem;
            padding: 10px 20px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .sidebar ul li a:hover {
            background: var(--blue-light);
            color: var(--black);
        }

        .sidebar ul li a i {
            margin-right: 15px;
        }

        .logout-section {
            padding: 20px;
            text-align: center;
            background: var(--blue-dark);
        }

        .logout-link {
            display: inline-block;
            padding: 12px 25px;
            color: var(--white);
            font-size: 1rem;
            font-weight: bold;
            text-decoration: none;
            border: 2px solid var(--white);
            border-radius: 5px;
            transition: all 0.3s ease;
            background: var(--blue-light);
        }

        .logout-link:hover {
            background: var(--white);
            color: var(--blue-dark);
        }

        .sidebar .close-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--white);
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
        <nav class="navbar-custom">
            <button class="btn btn-light me-3" id="menuToggle">
                <i class="fas fa-bars"></i>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">
                Aluvid
            </a>
        </nav>

        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <span class="close-btn" id="closeSidebar">&times;</span>
            @auth
                <div class="header">
                    <p class="user-name">{{ Auth::user()->name }}</p>
                </div>
            @endauth
            <ul>
                <li><a href="/cotizaciones/vidrio"><i class="fas fa-calculator"></i> Cotizar</a></li>
                <li><a href="/about"><i class="fas fa-info-circle"></i> Acerca de</a></li>
                <li><a href="/services"><i class="fas fa-concierge-bell"></i> Servicios</a></li>
                <li><a href="/contact"><i class="fas fa-envelope"></i> Contacto</a></li>
            </ul>
            @auth
                <div class="logout-section">
                    <a class="logout-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Cerrar Sesión
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            @endauth
        </div>

        <!-- Main Content -->
        <main class="py-4">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="footer">
            <div class="footer-links">
                <a href="/">Inicio</a>
                <a href="/about">Acerca de</a>
                <a href="/contact">Contacto</a>
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

    <!-- Sidebar Toggle Script -->
    <script>
        const sidebar = document.getElementById('sidebar');

        document.getElementById('menuToggle').addEventListener('click', function () {
            sidebar.classList.add('active');
        });

        document.getElementById('closeSidebar').addEventListener('click', function () {
            sidebar.classList.remove('active');
        });
    </script>
</body>
</html>
