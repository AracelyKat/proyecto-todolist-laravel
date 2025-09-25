<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','To-Do List')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="p-4 bg-light">

<!-- Encabezado -->
<header class="mb-4">
    <div class="d-flex justify-content-between align-items-center p-3 bg-dark rounded shadow">
        <h1 class="text-white mb-0">ToDoList Laravel</h1>
        <nav>
            <a href="{{ route('tasks.index') }}" class="btn btn-outline-light btn-sm me-2">Tareas</a>
            <a href="{{ route('categories.index') }}" class="btn btn-outline-light btn-sm me-2">Categorías</a>
            <a href="{{ route('tags.index') }}" class="btn btn-outline-light btn-sm">Etiquetas</a>
        </nav>
    </div>
</header>

<!-- Contenido principal -->
<div class="container">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
