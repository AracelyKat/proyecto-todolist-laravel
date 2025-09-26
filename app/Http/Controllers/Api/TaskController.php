<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Listar todas las tareas con su categoría y etiquetas.
     */
    public function index()
    {
        $tasks = Task::with(['category', 'tags'])->latest()->get();
        return response()->json(['data' => $tasks], 200);
    }

    /**
     * Crear una nueva tarea.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'tags'        => 'array',
            'tags.*'      => 'exists:tags,id'
        ]);

        $task = Task::create($validated);

        if (!empty($validated['tags'])) {
            $task->tags()->attach($validated['tags']);
        }

        return response()->json([
            'message' => 'Tarea creada correctamente',
            'data' => $task->load(['category', 'tags'])
        ], 201);
    }

    /**
     * Mostrar una tarea específica con su categoría y etiquetas.
     */
    public function show(Task $task)
    {
        $task->load(['category', 'tags']);
        return response()->json(['data' => $task], 200);
    }

    /**
     * Actualizar una tarea existente.
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'tags'        => 'array',
            'tags.*'      => 'exists:tags,id'
        ]);

        $task->update($validated);
        $task->tags()->sync($validated['tags'] ?? []);

        return response()->json([
            'message' => 'Tarea actualizada correctamente',
            'data' => $task->load(['category', 'tags'])
        ], 200);
    }

    /**
     * Eliminar una tarea.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json([
            'message' => 'Tarea eliminada correctamente'
        ], 200);
    }

    /**
     * Cambiar el estado de completada/incompleta.
     * (opcional si se quiere manejar el toggle desde la API)
     */
    public function toggle(Request $request, Task $task)
    {
        $validated = $request->validate([
            'completed' => 'required|boolean'
        ]);

        $task->status = $validated['completed'] ? 'completada' : 'incompleto';
        $task->save();

        return response()->json([
            'success' => true,
            'status'  => $task->status
        ], 200);
    }
}
