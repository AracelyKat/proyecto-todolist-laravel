@extends('layout')

@section('title','Listado de Tareas')

@section('content')
<h1>Listado de Tareas</h1>
<a href="{{ route('tasks.create') }}" class="btn btn-success mb-3">Nueva Tarea</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Estado</th>
            <th>Título</th>
            <th>Categoría</th>
            <th>Etiquetas</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($tasks as $task)
        <tr class="{{ $task->status == 'completada' ? 'completed' : '' }}">
            <td>
                <input type="checkbox" class="task-status" data-id="{{ $task->id }}" 
                       {{ $task->status == 'completada' ? 'checked' : '' }}>
            </td>
            <td>{{ $task->title }}</td>
            <td>{{ $task->category->name ?? 'Sin categoría' }}</td>
            <td>
                @foreach($task->tags as $tag)
                    <span class="badge bg-info">{{ $tag->name }}</span>
                @endforeach
            </td>
            <td>
                <a href="{{ route('tasks.show',$task) }}" class="btn btn-info btn-sm">Ver</a>
                <a href="{{ route('tasks.edit',$task) }}" class="btn btn-warning btn-sm">Editar</a>
                <form action="{{ route('tasks.destroy',$task) }}" method="POST" style="display:inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar?')">Borrar</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<style>
    .completed td {
        text-decoration: line-through;
        color: gray;
    }
</style>

<script>
    document.querySelectorAll('.task-status').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const taskId = this.dataset.id;
            const completed = this.checked ? 1 : 0;

            // Actualizar la clase visual
            if(this.checked) {
                this.closest('tr').classList.add('completed');
            } else {
                this.closest('tr').classList.remove('completed');
            }

            // Llamada al backend para actualizar estado
            fetch(`/tasks/${taskId}/toggle`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ completed: completed })
            })
            .then(response => response.json())
            .then(data => console.log(data))
            .catch(error => console.error(error));
        });
    });
</script>

@endsection
