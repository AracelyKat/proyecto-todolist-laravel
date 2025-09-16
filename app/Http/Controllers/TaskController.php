<?php

namespace App\Http\Controllers;

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
        $tasks = Task::with('category','tags')->orderBy('created_at','desc')->get();
        $categories = Category::all();
        $tags = Tag::all();
        return view('tasks.index', compact('tasks','categories','tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id'
        ]);

        $task = Task::create([
            'title'=>$validated['title'],
            'description'=>$validated['description'],
            'category_id'=>$validated['category_id'],
            'status'=>'incompleto'
        ]);

        if(!empty($request->tags)) $task->tags()->sync($request->tags);

        return redirect()->route('tasks.index')->with('success','Tarea creada');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->route('tasks.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
            'status' => 'in:incompleto,completada'
        ]);

        $task->update([
            'title'=>$validated['title'],
            'description'=>$validated['description'],
            'category_id'=>$validated['category_id'],
            'status'=>$validated['status'] ?? $task->status
        ]);

        $task->tags()->sync($request->tags ?? []);

        return redirect()->route('tasks.index')->with('success','Tarea actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
