<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Website Resmi Jurusan Pertanian">

    <title>@yield('title') | Jurusan Pertanian </title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- icon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    @stack('styles')

    <style>
        :root {
            --primary-color: #2e7d32;
            --secondary-color: #f8f9fa;
            --accent-color: #ffc107;
            --dark-color: #403834;
            --light-color: #ffffff;
        }

        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }

        .custom-navbar {
            background: linear-gradient(to right, #2e7d32, #2e7d32) !important;
            border: none !important;
        }

        .custom-navbar .nav-link,
        .custom-navbar .navbar-brand {
            color: white !important;
        }

        .custom-navbar .nav-link:hover {
            color: #d4fcd7 !important;
        }

    </style>
</head>
<body>
    @include('layouts.navbar')

    <main>

        @yield('content')


    </main>

    @include('layouts.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>
