@extends('layout')

@section('title','Editar Categoría')

@section('content')
<h1>Editar Categoría</h1>

<form action="{{ route('categories.update',$category) }}" method="POST">
@csrf @method('PUT')
    <div class="mb-3">
        <label>Nombre</label>
        <input name="name" class="form-control" value="{{ $category->name }}" required>
    </div>

    <button class="btn btn-primary">Actualizar</button>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
