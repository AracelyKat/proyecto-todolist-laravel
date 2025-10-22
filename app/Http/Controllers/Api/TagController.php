<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Listar todas las etiquetas.
     */
    public function index(Request $request)
    {
        //$tags = Tag::all();
        //return response()->json(['data' => $tags], 200);
        $usePagination = $request->query('pages', 'false') === 'true';
        $tagList = Tag::orderBy('created_at', 'desc');
        
        if($usePagination) {
            $tags = $tagList->paginate(3);
        } else {
            $tags = $tagList->get();
        }
        
        return response()->json(['data' => $tags]);
    }

    /**
     * Crear una nueva etiqueta.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $tag = Tag::create($validated);

        return response()->json([
            'message' => 'Etiqueta creada correctamente',
            'data' => $tag
        ], 201);
    }

    /**
     * Mostrar una etiqueta específica.
     */
    public function show(Tag $tag)
    {
        return response()->json(['data' => $tag], 200);
    }

    /**
     * Actualizar una etiqueta existente.
     */
    public function update(Request $request, Tag $tag)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $tag->update($validated);

        return response()->json([
            'message' => 'Etiqueta actualizada correctamente',
            'data' => $tag
        ], 200);
    }

    /**
     * Eliminar una etiqueta.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return response()->json([
            'message' => 'Etiqueta eliminada correctamente'
        ], 200);
    }
}
