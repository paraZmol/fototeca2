<?php

namespace App\Http\Controllers\Admin;

use App\Enums\HistoricalPeriod;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Location;
use App\Models\Photo;
use App\Models\Photographer;
use App\Models\Subcategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function index(Request $request)
    {
        $query = Photo::with(['location', 'photographers'])->latest();

        if ($search = $request->input('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $photos = $query->paginate(20)->withQueryString();

        return view('admin.photos.index', compact('photos'));
    }

    public function create()
    {
        $locations    = Location::orderBy('name')->get();
        $photographers = Photographer::orderBy('name')->get();
        $categories   = Category::whereNull('parent_id')->with('children')->orderBy('name')->get();
        $tags         = Tag::orderBy('name')->get();
        $periods      = HistoricalPeriod::cases();

        return view('admin.photos.create', compact('locations', 'photographers', 'categories', 'tags', 'periods'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'            => ['required', 'string', 'max:255'],
            'description'      => ['nullable', 'string'],
            'year'             => ['nullable', 'integer', 'min:1800', 'max:2100'],
            'circa'            => ['boolean'],
            'location_id'      => ['nullable', 'exists:locations,id'],
            'historical_period'=> ['nullable', 'in:pre_terremoto,terremoto_1970,reconstruccion,siglo_xxi'],
            'original_format'  => ['nullable', 'string', 'max:100'],
            'source_archive'   => ['nullable', 'string', 'max:255'],
            'source_reference' => ['nullable', 'string', 'max:255'],
            'is_published'     => ['boolean'],
            'image_type'       => ['required', 'in:file,url'],
            'image_file'       => ['nullable', 'file', 'image', 'max:15360'],
            'image_url'        => ['nullable', 'url', 'max:2048'],
            'photographers'    => ['nullable', 'array'],
            'photographers.*'  => ['exists:photographers,id'],
            'photographer_roles' => ['nullable', 'array'],
            'categories'       => ['nullable', 'array'],
            'categories.*'     => ['exists:categories,id'],
            'tags'             => ['nullable', 'array'],
            'tags.*'           => ['exists:tags,id'],
            'subcategories'    => ['nullable', 'array'],
            'subcategories.*'  => ['exists:subcategories,id'],
        ]);

        if ($request->input('image_type') === 'file') {
            if ($request->hasFile('image_file')) {
                $data['image_path'] = $request->file('image_file')->store('photos', 'public');
            }
            $data['image_url'] = null;
        } else {
            $data['image_url']  = $request->input('image_url');
            $data['image_path'] = null;
        }

        $data['circa']        = $request->boolean('circa');
        $data['is_published'] = $request->boolean('is_published');

        $photo = Photo::create($data);

        if ($request->filled('photographers')) {
            $sync = [];
            foreach ($request->input('photographers') as $pid) {
                $role = $request->input("photographer_roles.{$pid}", 'photographer');
                $sync[$pid] = ['role' => $role];
            }
            $photo->photographers()->sync($sync);
        }

        if ($request->filled('categories')) {
            $photo->categories()->sync($request->input('categories'));
        }

        if ($request->filled('tags')) {
            $photo->tags()->sync($request->input('tags'));
        }

        $photo->subcategories()->sync($request->input('subcategories', []));

        return redirect()->route('admin.fotos.index')->with('success', 'Fotografía creada correctamente.');
    }

    public function edit(Photo $photo)
    {
        $locations      = Location::orderBy('name')->get();
        $photographers  = Photographer::orderBy('name')->get();
        $categories     = Category::whereNull('parent_id')->with('children')->orderBy('name')->get();
        $subcategories  = Subcategory::with('category')->orderBy('name')->get();
        $tags           = Tag::orderBy('name')->get();
        $periods        = HistoricalPeriod::cases();

        $photo->load(['photographers', 'categories', 'subcategories', 'tags']);

        return view('admin.photos.edit', compact('photo', 'locations', 'photographers', 'categories', 'subcategories', 'tags', 'periods'));
    }

    public function update(Request $request, Photo $photo)
    {
        $data = $request->validate([
            'title'            => ['required', 'string', 'max:255'],
            'description'      => ['nullable', 'string'],
            'year'             => ['nullable', 'integer', 'min:1800', 'max:2100'],
            'circa'            => ['boolean'],
            'location_id'      => ['nullable', 'exists:locations,id'],
            'historical_period'=> ['nullable', 'in:pre_terremoto,terremoto_1970,reconstruccion,siglo_xxi'],
            'original_format'  => ['nullable', 'string', 'max:100'],
            'source_archive'   => ['nullable', 'string', 'max:255'],
            'source_reference' => ['nullable', 'string', 'max:255'],
            'is_published'     => ['boolean'],
            'image_type'       => ['required', 'in:file,url'],
            'image_file'       => ['nullable', 'file', 'image', 'max:15360'],
            'image_url'        => ['nullable', 'url', 'max:2048'],
            'photographers'    => ['nullable', 'array'],
            'photographers.*'  => ['exists:photographers,id'],
            'photographer_roles' => ['nullable', 'array'],
            'categories'       => ['nullable', 'array'],
            'categories.*'     => ['exists:categories,id'],
            'tags'             => ['nullable', 'array'],
            'tags.*'           => ['exists:tags,id'],
            'subcategories'    => ['nullable', 'array'],
            'subcategories.*'  => ['exists:subcategories,id'],
        ]);

        if ($request->input('image_type') === 'file') {
            if ($request->hasFile('image_file')) {
                if ($photo->image_path) {
                    Storage::disk('public')->delete($photo->image_path);
                }
                $data['image_path'] = $request->file('image_file')->store('photos', 'public');
            } else {
                $data['image_path'] = $photo->image_path;
            }
            $data['image_url'] = null;
        } else {
            $data['image_url']  = $request->input('image_url');
            $data['image_path'] = null;
            if ($photo->image_path) {
                Storage::disk('public')->delete($photo->image_path);
            }
        }

        $data['circa']        = $request->boolean('circa');
        $data['is_published'] = $request->boolean('is_published');

        $photo->update($data);

        $sync = [];
        foreach ($request->input('photographers', []) as $pid) {
            $role = $request->input("photographer_roles.{$pid}", 'photographer');
            $sync[$pid] = ['role' => $role];
        }
        $photo->photographers()->sync($sync);
        $photo->categories()->sync($request->input('categories', []));
        $photo->tags()->sync($request->input('tags', []));
        $photo->subcategories()->sync($request->input('subcategories', []));

        return redirect()->route('admin.fotos.index')->with('success', 'Fotografía actualizada correctamente.');
    }

    public function destroy(Photo $photo)
    {
        if ($photo->image_path) {
            Storage::disk('public')->delete($photo->image_path);
        }
        $photo->delete();

        return redirect()->route('admin.fotos.index')->with('success', 'Fotografía eliminada.');
    }
}
