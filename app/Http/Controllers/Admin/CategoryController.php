<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('parent')->withCount('photos')->orderBy('name')->paginate(20);

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $parents = Category::whereNull('parent_id')->orderBy('name')->get();

        return view('admin.categories.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'slug'      => ['nullable', 'string', 'max:255', 'unique:categories,slug'],
            'icon'      => ['nullable', 'string', 'max:50'],
            'parent_id' => ['nullable', 'exists:categories,id'],
        ]);

        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);

        Category::create($data);

        return redirect()->route('admin.categorias.index')->with('success', 'Categoría creada correctamente.');
    }

    public function edit(Category $category)
    {
        $parents = Category::whereNull('parent_id')
            ->where('id', '!=', $category->id)
            ->orderBy('name')
            ->get();

        return view('admin.categories.edit', compact('category', 'parents'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'slug'      => ['nullable', 'string', 'max:255', "unique:categories,slug,{$category->id}"],
            'icon'      => ['nullable', 'string', 'max:50'],
            'parent_id' => ['nullable', 'exists:categories,id'],
        ]);

        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);

        $category->update($data);

        return redirect()->route('admin.categorias.index')->with('success', 'Categoría actualizada correctamente.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categorias.index')->with('success', 'Categoría eliminada.');
    }
}
