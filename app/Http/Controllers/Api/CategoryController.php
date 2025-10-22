<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Muestra un listado de todas las categorías.
     */
    public function index(Request $request)
    {
        //$categories = Category::all();
        //return response()->json(['data' => $categories]);
        $usePagination = $request->query('pages', 'false') === 'true';
        $categoryList = Category::orderBy('created_at', 'desc');
        
        if($usePagination) {
            $categories = $categoryList->paginate(3);
        } else {
            $categories = $categoryList->get();
        }
        
        return response()->json(['data' => $categories]);
    }

    /**
     * Almacena una nueva categoría en la base de datos.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $category = Category::create($validated);

        return response()->json([
            'message' => 'Categoría creada correctamente',
            'data' => $category
        ], 201);
    }

    /**
     * Muestra la información de una categoría específica.
     */
    public function show(Category $category)
    {
        return response()->json([
            'data' => $category,
        ], 200);
    }

    /**
     * Actualiza los datos de una categoría existente.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $category->update($validated);
        return response()->json([
            'message' => 'Categoría actualizada correctamente',
            'data' => $category
        ], 200);
    }

    /**
     * Elimina una categoría de la base de datos.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([
            'message' => 'Categoría eliminada correctamente'
        ], 200);
    }
}
