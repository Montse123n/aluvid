<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Login - My App')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            background: #001d4a;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        .auth-container {
            background: rgba(255, 255, 255, 0.97); /* Fondo blanco translúcido */
            border-radius: 15px;
            max-width: 900px;
            overflow: hidden;
            width: 100%;
            display: flex;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
        }

        .auth-image {
            flex: 1;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-image img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Ajuste perfecto al contenedor */
        }

        .auth-form {
            padding: 50px;
            flex: 1.5;
            background: #ffffff;
            color: #333;
        }

        .auth-form h3 {
            color: #003580;
            font-weight: bold;
        }

        .btn-primary {
            background-color: #003580;
            border-color: #003580;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .form-control {
            border: 2px solid #ddd;
            border-radius: 5px;
            padding: 10px 15px;
        }

        .form-control:focus {
            border-color: #003580;
            box-shadow: 0 0 5px rgba(0, 53, 128, 0.5);
        }

        .auth-footer {
            text-align: center;
            margin-top: 20px;
        }

        .auth-footer a {
            color: #003580;
            font-weight: bold;
            text-decoration: none;
        }

        .auth-footer a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-image">
            <!-- Imagen ajustada al tamaño del contenedor -->
            <img src="{{ asset('img/header-image.jpg') }}" alt="Secure Login">
        </div>
        <div class="auth-form">
            @yield('content')
        </div>
    </div>
</body>
</html>
