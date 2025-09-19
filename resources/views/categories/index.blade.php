@extends('layout')

@section('title','Listado de Categorías')

@section('content')
<h1>Categorías</h1>

<a href="{{ route('categories.create') }}" class="btn btn-success mb-3">Nueva Categoría</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($categories as $category)
        <tr>
            <td>{{ $category->name }}</td>
            <td>
                <a href="{{ route('categories.show',$category) }}" class="btn btn-info btn-sm">Ver</a>
                <a href="{{ route('categories.edit',$category) }}" class="btn btn-warning btn-sm">Editar</a>
                <form action="{{ route('categories.destroy',$category) }}" method="POST" style="display:inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta categoría?')">Borrar</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
