<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Photo;
use Illuminate\Http\Request;

class SpecialsController extends Controller
{
    // slugs de las 4 colecciones especiales fijas
    private const SPECIAL_SLUGS = [
        'desastres-ancash',
        'tradiciones-huaraz',
        'patrimonio-arqueologico',
        'pnh',
    ];

    public function index()
    {
        // cargar solo las 4 colecciones especiales con sus hijos y conteo de fotos
        $specials = Category::whereIn('slug', self::SPECIAL_SLUGS)
            ->with(['children.children'])
            ->get()
            ->sortBy(fn($c) => array_search($c->slug, self::SPECIAL_SLUGS))
            ->values();

        return view('specials.index', compact('specials'));
    }

    public function show(string $slug)
    {
        // obtener la coleccion especial por slug
        $collection = Category::where('slug', $slug)
            ->with(['children.children'])
            ->firstOrFail();

        // reunir todos los ids de la jerarquia (padre + hijos + nietos)
        $ids = $this->collectCategoryIds($collection);

        // query de fotos filtradas por estos ids
        $photos = Photo::with(['location', 'categories', 'photographers'])
            ->where('is_published', true)
            ->whereHas('categories', fn($q) => $q->whereIn('categories.id', $ids))
            ->orderByDesc('year')
            ->paginate(24)
            ->withQueryString();

        return view('specials.show', compact('collection', 'photos'));
    }

    private function collectCategoryIds(Category $cat): array
    {
        $ids = [$cat->id];
        foreach ($cat->children as $child) {
            $ids[] = $child->id;
            foreach ($child->children as $grandchild) {
                $ids[] = $grandchild->id;
            }
        }
        return $ids;
    }
}
