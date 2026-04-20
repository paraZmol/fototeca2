<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photographer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotographerController extends Controller
{
    public function index(Request $request)
    {
        $query = Photographer::withCount('photos')->orderBy('name');

        if ($search = $request->input('q')) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('pseudonym', 'like', "%{$search}%");
        }

        $photographers = $query->paginate(20)->withQueryString();

        return view('admin.photographers.index', compact('photographers'));
    }

    public function create()
    {
        return view('admin.photographers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'         => ['required', 'string', 'max:255'],
            'pseudonym'    => ['nullable', 'string', 'max:255'],
            'birth_year'   => ['nullable', 'integer', 'min:1800', 'max:2100'],
            'death_year'   => ['nullable', 'integer', 'min:1800', 'max:2100'],
            'nationality'  => ['nullable', 'string', 'max:100'],
            'biography'    => ['nullable', 'string'],
            'portrait'     => ['nullable', 'file', 'image', 'max:15360'],
            'is_anonymous' => ['boolean'],
        ]);

        if ($request->hasFile('portrait')) {
            $data['portrait_path'] = $request->file('portrait')->store('portraits', 'public');
        }

        $data['is_anonymous'] = $request->boolean('is_anonymous');

        Photographer::create($data);

        return redirect()->route('admin.fotografos.index')->with('success', 'Fotógrafo creado correctamente.');
    }

    public function edit(Photographer $photographer)
    {
        return view('admin.photographers.edit', compact('photographer'));
    }

    public function update(Request $request, Photographer $photographer)
    {
        $data = $request->validate([
            'name'         => ['required', 'string', 'max:255'],
            'pseudonym'    => ['nullable', 'string', 'max:255'],
            'birth_year'   => ['nullable', 'integer', 'min:1800', 'max:2100'],
            'death_year'   => ['nullable', 'integer', 'min:1800', 'max:2100'],
            'nationality'  => ['nullable', 'string', 'max:100'],
            'biography'    => ['nullable', 'string'],
            'portrait'     => ['nullable', 'file', 'image', 'max:15360'],
            'is_anonymous' => ['boolean'],
        ]);

        if ($request->hasFile('portrait')) {
            if ($photographer->portrait_path) {
                Storage::disk('public')->delete($photographer->portrait_path);
            }
            $data['portrait_path'] = $request->file('portrait')->store('portraits', 'public');
        }

        $data['is_anonymous'] = $request->boolean('is_anonymous');

        $photographer->update($data);

        return redirect()->route('admin.fotografos.index')->with('success', 'Fotógrafo actualizado correctamente.');
    }

    public function destroy(Photographer $photographer)
    {
        if ($photographer->portrait_path) {
            Storage::disk('public')->delete($photographer->portrait_path);
        }
        $photographer->delete();

        return redirect()->route('admin.fotografos.index')->with('success', 'Fotógrafo eliminado.');
    }
}
