@extends('layout')
@section('title','Editar Tarea')

@section('content')
<h1>Editar Tarea</h1>
<form action="{{ route('tasks.update',$task) }}" method="POST">
@csrf @method('PUT')
    <div class="mb-3">
        <label>Título</label>
        <input name="title" class="form-control" value="{{ $task->title }}" required>
    </div>

    <div class="mb-3">
        <label>Descripción</label>
        <textarea name="description" class="form-control">{{ $task->description }}</textarea>
    </div>

    <div class="mb-3">
        <label>Categoría</label>
        <select name="category_id" class="form-select">
            <option value="">-- Sin categoría --</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" @if($task->category_id==$cat->id) selected @endif>{{ $cat->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Etiquetas</label>
        @foreach($tags as $tag)
            <div>
                <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                @if($task->tags->contains($tag->id)) checked @endif> {{ $tag->name }}
            </div>
        @endforeach
    </div>

    <button class="btn btn-primary">Actualizar</button>
</form>
@endsection
