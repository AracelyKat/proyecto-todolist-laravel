@extends('layout')

@section('title','Nueva Categoría')

@section('content')
<h1>Nueva Categoría</h1>

<form action="{{ route('categories.store') }}" method="POST">
@csrf
    <div class="mb-3">
        <label>Nombre</label>
        <input name="name" class="form-control" required>
    </div>

    <button class="btn btn-primary">Guardar</button>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
