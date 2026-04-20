<?php

namespace App\Http\Controllers;

use App\Models\Photographer;
use Illuminate\Http\Request;

class PhotographerController extends Controller
{
    public function index()
    {
        // todos los fotografos ordenados por apellido (full_name)
        $photographers = Photographer::withCount('photos')
            ->whereNotNull('birth_place')
            ->orWhere(function ($q) {
                $q->whereNull('birth_place')->whereNotNull('bio');
            })
            ->orderBy('full_name')
            ->get();

        // fotografo anonimo para la sección especial al final
        $anonymous = Photographer::where('full_name', 'like', '%Desconocido%')
            ->orWhere('full_name', 'like', '%Anónimo%')
            ->orWhere('full_name', 'like', '%Autor%')
            ->first();

        return view('photographers.index', compact('photographers', 'anonymous'));
    }

    public function show(Photographer $photographer)
    {
        $photos = $photographer->photos()
            ->with(['location', 'categories'])
            ->where('is_published', true)
            ->paginate(12);

        return view('photographers.show', compact('photographer', 'photos'));
    }
}
