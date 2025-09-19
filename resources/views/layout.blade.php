<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','To-Do List')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="p-4">

<nav class="mb-4 bg-info">
    <a href="{{ route('tasks.index') }}" class="btn btn-primary btn-sm">Tareas</a>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary btn-sm">Categorías</a>
    <a href="{{ route('tags.index') }}" class="btn btn-info btn-sm">Etiquetas</a>
</nav>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @yield('content')
</div>

</body>
</html>
