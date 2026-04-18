<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubcategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Subcategory::with('category.location')->withCount('photos')->orderBy('name');

        if ($search = $request->input('q')) {
            $query->where('name', 'like', "%{$search}%");
        }

        $subcategories = $query->paginate(20)->withQueryString();

        return view('admin.subcategories.index', compact('subcategories'));
    }

    public function create()
    {
        $categories = Category::with('location')->orderBy('name')->get();

        return view('admin.subcategories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'slug'        => ['nullable', 'string', 'max:255', 'unique:subcategories,slug'],
            'icon'        => ['nullable', 'string', 'max:50'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);

        Subcategory::create($data);

        return redirect()->route('admin.subcategorias.index')->with('success', 'Subcategoría creada correctamente.');
    }

    public function edit(Subcategory $subcategory)
    {
        $categories = Category::with('location')->orderBy('name')->get();

        return view('admin.subcategories.edit', compact('subcategory', 'categories'));
    }

    public function update(Request $request, Subcategory $subcategory)
    {
        $data = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'slug'        => ['nullable', 'string', 'max:255', "unique:subcategories,slug,{$subcategory->id}"],
            'icon'        => ['nullable', 'string', 'max:50'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);

        $subcategory->update($data);

        return redirect()->route('admin.subcategorias.index')->with('success', 'Subcategoría actualizada correctamente.');
    }

    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();

        return redirect()->route('admin.subcategorias.index')->with('success', 'Subcategoría eliminada.');
    }
}
