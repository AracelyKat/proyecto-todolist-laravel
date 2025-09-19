@extends('layout')

@section('title','Listado de Etiquetas')

@section('content')
<h1>Etiquetas</h1>

<a href="{{ route('tags.create') }}" class="btn btn-success mb-3">Nueva Etiqueta</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($tags as $tag)
        <tr>
            <td>{{ $tag->name }}</td>
            <td>
                <a href="{{ route('tags.show',$tag) }}" class="btn btn-info btn-sm">Ver</a>
                <a href="{{ route('tags.edit',$tag) }}" class="btn btn-warning btn-sm">Editar</a>
                <form action="{{ route('tags.destroy',$tag) }}" method="POST" style="display:inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta etiqueta?')">Borrar</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
