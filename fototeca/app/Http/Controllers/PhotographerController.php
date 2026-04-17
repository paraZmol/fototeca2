<?php

namespace App\Http\Controllers;

use App\Models\Photographer;
use Illuminate\Http\Request;

class PhotographerController extends Controller
{
    public function index()
    {
        $photographers = Photographer::where('is_anonymous', false)
            ->withCount('photos')
            ->orderBy('name')
            ->get();
            
        $anonymous = Photographer::where('is_anonymous', true)->first();

        return view('photographers.index', compact('photographers', 'anonymous'));
    }

    public function show(Photographer $photographer)
    {
        $photos = $photographer->photos()->with(['locations', 'categories'])->paginate(12);
        
        return view('photographers.show', compact('photographer', 'photos'));
    }
}
