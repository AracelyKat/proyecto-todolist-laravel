@extends('layout')

@section('title','Editar Etiqueta')

@section('content')
<h1>Editar Etiqueta</h1>

<form action="{{ route('tags.update',$tag) }}" method="POST">
@csrf @method('PUT')
    <div class="mb-3">
        <label>Nombre</label>
        <input name="name" class="form-control" value="{{ $tag->name }}" required>
    </div>

    <button class="btn btn-primary">Actualizar</button>
    <a href="{{ route('tags.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
