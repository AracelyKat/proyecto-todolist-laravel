@extends('layout')
@section('title','Nueva Tarea')

@section('content')
<h1>Nueva Tarea</h1>
<form action="{{ route('tasks.store') }}" method="POST">
@csrf
    <div class="mb-3">
        <label>Título</label>
        <input name="title" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Descripción</label>
        <textarea name="description" class="form-control"></textarea>
    </div>

    <div class="mb-3">
        <label>Categoría</label>
        <select name="category_id" class="form-select">
            <option value="">-- Sin categoría --</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Etiquetas</label>
        @foreach($tags as $tag)
            <div>
                <input type="checkbox" name="tags[]" value="{{ $tag->id }}"> {{ $tag->name }}
            </div>
        @endforeach
    </div>

    <button class="btn btn-primary">Guardar</button>
</form>
@endsection
