<?php

namespace App\Http\Controllers\Admin;

use App\Enums\LocationType;
use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::with('parent')->withCount('photos')->orderBy('name')->paginate(20);

        return view('admin.locations.index', compact('locations'));
    }

    public function create()
    {
        $parents = Location::orderBy('name')->get();
        $types   = LocationType::cases();

        return view('admin.locations.create', compact('parents', 'types'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'type'      => ['required', 'in:region,province,district,neighborhood,place'],
            'parent_id' => ['nullable', 'exists:locations,id'],
        ]);

        Location::create($data);

        return redirect()->route('admin.ubicaciones.index')->with('success', 'Ubicación creada correctamente.');
    }

    public function edit(Location $location)
    {
        $parents = Location::where('id', '!=', $location->id)->orderBy('name')->get();
        $types   = LocationType::cases();

        return view('admin.locations.edit', compact('location', 'parents', 'types'));
    }

    public function update(Request $request, Location $location)
    {
        $data = $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'type'      => ['required', 'in:region,province,district,neighborhood,place'],
            'parent_id' => ['nullable', 'exists:locations,id'],
        ]);

        $location->update($data);

        return redirect()->route('admin.ubicaciones.index')->with('success', 'Ubicación actualizada correctamente.');
    }

    public function destroy(Location $location)
    {
        $location->delete();

        return redirect()->route('admin.ubicaciones.index')->with('success', 'Ubicación eliminada.');
    }
}
