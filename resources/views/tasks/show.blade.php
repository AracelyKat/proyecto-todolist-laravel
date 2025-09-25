@extends('layout')
@section('title','Detalle Tarea')

@section('content')
<h1>{{ $task->title }}</h1>

<p>
    <strong>Estado:</strong> 
    @if($task->status == 'completada')
        <span class="badge bg-success">Completada</span>
    @else
        <span class="badge bg-warning text-dark">Incompleta</span>
    @endif
</p>

<p><strong>Descripción:</strong> {{ $task->description }}</p>
<p><strong>Categoría:</strong> {{ $task->category->name ?? 'Sin categoría' }}</p>
<p><strong>Etiquetas:</strong>
    @foreach($task->tags as $tag)
        <span class="badge bg-info">{{ $tag->name }}</span>
    @endforeach
</p>

<a href="{{ route('tasks.index') }}" class="btn btn-secondary">Volver</a>
@endsection
