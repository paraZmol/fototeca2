<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Location;
use App\Models\Photo;
use App\Models\Photographer;
use App\Models\Subcategory;
use App\Models\Tag;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'photos'          => Photo::count(),
            'published'       => Photo::where('is_published', true)->count(),
            'photographers'   => Photographer::count(),
            'categories'      => Category::count(),
            'subcategories'   => Subcategory::count(),
            'locations'       => Location::count(),
            'tags'            => Tag::count(),
            'users'           => User::count(),
        ];

        $recentPhotos = Photo::latest()->take(6)->get();

        return view('admin.dashboard', compact('stats', 'recentPhotos'));
    }
}
