<?php

namespace App\Http\Controllers;

use App\Enums\HistoricalPeriod;
use App\Models\Location;
use App\Models\Photo;
use App\Models\Photographer;

class HomeController extends Controller
{
    public function index()
    {
        $stats = [
            'photos'        => Photo::published()->count(),
            'photographers' => Photographer::where('is_anonymous', false)->count(),
            'locations'     => Location::where('type', \App\Enums\LocationType::Neighborhood)->count(),
            'since'         => Photo::published()->whereNotNull('year')->min('year') ?? 1948,
        ];

        $featuredPhotos = Photo::published()
            ->with(['photographers', 'location'])
            ->inRandomOrder()
            ->take(6)
            ->get();

        $photographers = Photographer::where('is_anonymous', false)
            ->withCount('photos')
            ->get();

        // Single query instead of four separate counts
        $rawCounts = Photo::published()
            ->selectRaw('historical_period, COUNT(*) as total')
            ->whereNotNull('historical_period')
            ->groupBy('historical_period')
            ->pluck('total', 'historical_period');

        $periodCounts = collect(HistoricalPeriod::cases())
            ->mapWithKeys(fn($p) => [$p->value => (int) $rawCounts->get($p->value, 0)]);

        return view('home', compact('stats', 'featuredPhotos', 'photographers', 'periodCounts'));
    }
}
