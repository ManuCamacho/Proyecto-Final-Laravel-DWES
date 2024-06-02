<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

/**
 * Controlador para la gestión de categorías.
 */
class CategoriesController extends Controller
{
    /**
     * Muestra una lista de todas las categorías.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Almacena una nueva categoría.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
        ]);

        try {
            $category = new Category;
            $category->name = $request->name;
            $category->save();

            // Relacionar la categoría con el usuario autenticado
            $user = auth()->user();
            $category->users()->attach($user);

            return redirect()->route('categories.index')->with('success', 'Categoría creada correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Error al crear la categoría: ' . $e->getMessage());
        }
    }

    /**
     * Actualiza una categoría existente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($request->id);
        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('categories.index')->with('success', 'Categoría actualizada correctamente.');
    }

    /**
     * Elimina una categoría.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
        ]);

        try {
            $category = Category::findOrFail($request->category_id);
            $category->delete();
            return redirect()->route('categories.index')->with('success', 'Categoría eliminada correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Error al eliminar la categoría: ' . $e->getMessage());
        }
    }   
}
