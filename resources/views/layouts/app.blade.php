<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Daftar Film') | JOFLEX</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('movies.index') }}">
            <i class="bi bi-film"></i> JOFLEX
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('movies.index') ? 'active' : '' }}"
                       href="{{ route('movies.index') }}">Daftar Film</a>
                </li>
            </ul>
            <form class="d-flex" action="{{ route('movies.index') }}" method="GET">
                <input class="form-control me-2" type="search" name="q"
                       value="{{ request('q') }}" placeholder="Cari judul...">
                <button class="btn btn-accent" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>

<main class="container py-4 flex-grow-1">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</main>

<footer class="text-center text-secondary py-4 border-top">
    <i class="bi bi-film text-danger"></i> [JOFLEX]. All rights reserved. &copy; {{ date('Y') }}
</footer>

</body>
</html>