@extends('layout')

@section('title','Detalle Categoría')

@section('content')
<h1>{{ $category->name }}</h1>

<p><strong>ID:</strong> {{ $category->id }}</p>
<p><strong>Creada:</strong> {{ $category->created_at->format('d/m/Y H:i') }}</p>

<a href="{{ route('categories.index') }}" class="btn btn-secondary">Volver</a>
@endsection
