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
     * Listar todas las tareas.
     */
    public function index(Request $request)
    {
        $tasks = Task::with(['category', 'tags'])
                 ->where('user_id', $request->user()->id)
                 ->latest()
                 ->get();
        //$tasks = Task::with(['category', 'tags'])->latest()->get();
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
            'status'      => 'nullable|in:completada,incompleto'
        ]);

        $task = $request->user()->tasks()->create($validated);
        if (!empty($validated['tags'])) {
            $task->tags()->attach($validated['tags']);
        }

        return response()->json([
            'message' => 'Tarea creada correctamente',
            'data' => $task
        ], 201);
    }

    /**
     * Mostrar una tarea específica.
     */
    public function show(Task $task)
    {
        $task->load(['category','tags']);
        return response()->json(['data' => $task], 200);
    }

    /**
     * Actualizar una tarea existente (incluye completar la tarea).
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'tags'        => 'array',
            'status'      => 'nullable|in:completada,incompleto'
        ]);

        $task->update($validated);

        if (isset($validated['tags'])) {
            $task->tags()->sync($validated['tags']);
        }

        return response()->json([
            'message' => 'Tarea actualizada correctamente',
            'data' => $task
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
}
