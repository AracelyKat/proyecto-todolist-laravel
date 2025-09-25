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
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::with(['category', 'tags'])->latest()->get();
        //return view('tasks.index', compact('tasks'));
        return response()->json(['data' => $tasks]);
    }
    //comentar ctrl+k+c, descomentar ctrol+k+u
    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     $categories = Category::all();
    //     $tags = Tag::all();
    //     return view('tasks.create', compact('categories','tags'));
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'title'       => 'required|string|max:255',
    //         'description' => 'nullable|string',
    //         'category_id' => 'nullable|exists:categories,id',
    //         'tags'        => 'array'
    //     ]);

    //     $task = Task::create($validated);
    //     if (!empty($validated['tags'])) {
    //         $task->tags()->attach($validated['tags']);
    //     }

    //     return redirect()->route('tasks.index')
    //                      ->with('success','Tarea creada correctamente');
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Task $task)
    // {
    //     $task->load(['category','tags']);
    //     return view('tasks.show', compact('task'));
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(Task $task)
    // {
    //     $categories = Category::all();
    //     $tags = Tag::all();
    //     $task->load('tags');
    //     return view('tasks.edit', compact('task','categories','tags'));
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, Task $task)
    // {
    //     $validated = $request->validate([
    //         'title'       => 'required|string|max:255',
    //         'description' => 'nullable|string',
    //         'category_id' => 'nullable|exists:categories,id',
    //         'tags'        => 'array'
    //     ]);

    //     $task->update($validated);
    //     $task->tags()->sync($validated['tags'] ?? []);

    //     return redirect()->route('tasks.index')
    //                      ->with('success','Tarea actualizada correctamente');
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Task $task)
    // {
    //     $task->delete();
    //     return redirect()->route('tasks.index')
    //                      ->with('success','Tarea eliminada');
    // }

    // public function toggle(Request $request, Task $task)
    // {
    //     $task->status = $request->completed ? 'completada' : 'incompleto';
    //     $task->save();

    //     return response()->json([
    //         'success' => true,
    //         'status' => $task->status
    //     ]);
    //}
}
