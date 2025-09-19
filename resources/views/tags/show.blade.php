@extends('layout')

@section('title','Detalle Etiqueta')

@section('content')
<h1>{{ $tag->name }}</h1>

<p><strong>ID:</strong> {{ $tag->id }}</p>
<p><strong>Creada:</strong> {{ $tag->created_at->format('d/m/Y H:i') }}</p>

<a href="{{ route('tags.index') }}" class="btn btn-secondary">Volver</a>
@endsection
