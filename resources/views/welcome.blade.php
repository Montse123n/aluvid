<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            color: #333;
            background-color: #f4f6f9;
        }

        /* Navbar */
        .navbar-custom {
            background-color: #1a1a1a;
            border-bottom: 2px solid #007bff;
        }
        .navbar-custom .nav-link {
            color: #ffffff !important;
            font-size: 1rem;
            font-weight: 500;
        }
        .navbar-custom .nav-link:hover {
            color: #007bff !important;
        }
        .navbar-custom .navbar-brand {
            color: #007bff !important;
            font-size: 1.5rem;
            font-weight: bold;
        }

        /* Header */
        .header {
            background: url('img/header-image.jpg') no-repeat center center/cover;
            color: #ffffff;
            text-align: center;
            padding: 120px 0;
        }
        .header h1 {
            font-size: 3.5rem;
            font-weight: 700;
            text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.5);
        }
        .header p {
            font-size: 1.5rem;
            font-weight: 400;
        }

        /* Sectores */
        .sectors-section {
            padding: 4rem 0;
            background-color: #ffffff;
        }
        .sectors-section h2 {
            color: #1a1a1a;
            font-weight: 700;
            text-align: center;
            margin-bottom: 2rem;
            font-size: 2.5rem;
        }
        .sector-card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            background-color: #f8f9fa;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .sector-card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }
        .sector-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .sector-title {
            font-size: 1.3rem;
            color: #ffffff;
            background-color: #007bff;
            padding: 10px 15px;
            text-align: center;
            border-radius: 0 0 10px 10px;
        }

        /* Footer */
        .footer {
            background-color: #1a1a1a;
            color: #f4f6f9;
            padding: 3rem 0;
            font-size: 0.9rem;
        }
        .footer h5 {
            color: #007bff;
            font-size: 1.1rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }
        .footer a {
            color: #ffffff;
            text-decoration: none;
        }
        .footer a:hover {
            color: #007bff;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="#">Tienda de Vidrios y Aluminios</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Cotización</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Nosotros</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Iniciar Sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="header">
        <div class="container">
            <h1>Bienvenido a la tienda de vidrios y aluminios</h1>
            <p>Explora nuestros productos y servicios</p>
        </div>
    </header>

    <!-- Nosotros -->
    <section class="company-info">
        <div class="container text-center py-5">
            <h2 class="text-primary">Sobre Nosotros</h2>
            <p class="text-muted">
                Somos líderes en la industria de vidrios y aluminios, comprometidos en ofrecer productos de la más alta calidad y servicio excepcional.
            </p>
        </div>
    </section>

    <!-- Sectores -->
    <section class="sectors-section">
        <div class="container">
            <h2>Nuestros Sectores</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="sector-card">
                        <img src="img/aluminio.jpg" alt="Aluminios">
                        <div class="sector-title">Aluminios</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="sector-card">
                        <img src="img/vidrios.jpg" alt="Vidrios">
                        <div class="sector-title">Vidrios</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="sector-card">
                        <img src="img/herrajes.jpg" alt="Herrajes">
                        <div class="sector-title">Herrajes</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Contacto</h5>
                    <p>1234 Calle Ejemplo, Ciudad, País</p>
                    <p>Email: contacto@empresa.com</p>
                    <p>Teléfono: +1 234 567 890</p>
                </div>
                <div class="col-md-4">
                    <h5>Síguenos</h5>
                    <a href="#">Facebook</a> | <a href="#">Twitter</a> | <a href="#">Instagram</a>
                </div>
                <div class="col-md-4">
                    <h5>Enlaces útiles</h5>
                    <a href="#">Inicio</a><br>
                    <a href="#">Cotización</a><br>
                    <a href="#">Nosotros</a>
                </div>
            </div>
            <p class="text-center mt-4">© 2024 Tienda de Vidrios y Aluminios. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
