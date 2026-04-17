<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index(Request $request)
    {
        $query = Tag::withCount('photos')->orderBy('name');

        if ($search = $request->input('q')) {
            $query->where('name', 'like', "%{$search}%");
        }

        $tags = $query->paginate(30)->withQueryString();

        return view('admin.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:tags,name'],
            'slug' => ['nullable', 'string', 'max:100', 'unique:tags,slug'],
        ]);

        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);

        Tag::create($data);

        return redirect()->route('admin.etiquetas.index')->with('success', 'Etiqueta creada correctamente.');
    }

    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', "unique:tags,name,{$tag->id}"],
            'slug' => ['nullable', 'string', 'max:100', "unique:tags,slug,{$tag->id}"],
        ]);

        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);

        $tag->update($data);

        return redirect()->route('admin.etiquetas.index')->with('success', 'Etiqueta actualizada correctamente.');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()->route('admin.etiquetas.index')->with('success', 'Etiqueta eliminada.');
    }
}
