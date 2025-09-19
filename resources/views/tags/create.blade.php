@extends('layout')

@section('title','Nueva Etiqueta')

@section('content')
<h1>Nueva Etiqueta</h1>

<form action="{{ route('tags.store') }}" method="POST">
@csrf
    <div class="mb-3">
        <label>Nombre</label>
        <input name="name" class="form-control" required>
    </div>

    <button class="btn btn-primary">Guardar</button>
    <a href="{{ route('tags.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
