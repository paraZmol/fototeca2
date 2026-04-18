<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Category;
use App\Models\Photo;
use App\Models\Subcategory;
use App\Enums\HistoricalPeriod;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        // arbol de provincias con sus hijos recursivos para el sidebar
        $provinces = Location::provinces()
            ->with('allChildren')
            ->orderBy('name')
            ->get();

        // categorias raiz con hijos y subcategorias para el panel tematico
        $rootCategories = Category::whereNull('parent_id')
            ->with(['children.subcategories'])
            ->orderBy('name')
            ->get();

        // todos los periodos historicos para la barra de filtros especiales
        $periods = HistoricalPeriod::cases();

        // query base de fotos publicadas
        $query = Photo::with(['location', 'categories', 'subcategories', 'photographers'])
            ->where('is_published', true);

        // filtro por busqueda de texto libre
        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // filtro por periodo historico
        if ($request->filled('period')) {
            $period = HistoricalPeriod::tryFrom($request->period);
            if ($period) {
                $query->where('historical_period', $period);
            }
        }

        // filtro por ubicacion geografica (incluye descendientes del nodo seleccionado)
        if ($request->filled('location')) {
            $locationId = (int) $request->location;
            $ids = Location::descendantIds($locationId);
            $ids[] = $locationId;
            $query->whereIn('location_id', $ids);
        }

        // filtro por categoria tematica (incluye hijos directos)
        if ($request->filled('category')) {
            $categoryId = (int) $request->category;
            $childIds = Category::where('parent_id', $categoryId)->pluck('id')->toArray();
            $ids = array_merge([$categoryId], $childIds);
            $query->whereHas('categories', function ($q) use ($ids) {
                $q->whereIn('categories.id', $ids);
            });
        }

        // filtro por subcategoria
        if ($request->filled('subcategory')) {
            $subcategoryId = (int) $request->subcategory;
            $query->whereHas('subcategories', function ($q) use ($subcategoryId) {
                $q->where('subcategories.id', $subcategoryId);
            });
        }

        $photos = $query->orderByDesc('year')->paginate(24)->withQueryString();

        // etiqueta del contexto activo para el titulo de la galeria
        $activeLabel = $this->resolveActiveLabel($request);

        return view('gallery.index', compact(
            'provinces',
            'rootCategories',
            'periods',
            'photos',
            'activeLabel'
        ));
    }

    private function resolveActiveLabel(Request $request): string
    {
        if ($request->filled('q')) {
            return 'Búsqueda: "' . $request->q . '"';
        }
        if ($request->filled('location')) {
            $loc = Location::find((int) $request->location);
            if ($loc) return $loc->name;
        }
        if ($request->filled('subcategory')) {
            $sub = Subcategory::find((int) $request->subcategory);
            if ($sub) return $sub->name;
        }
        if ($request->filled('category')) {
            $cat = Category::find((int) $request->category);
            if ($cat) return $cat->name;
        }
        if ($request->filled('period')) {
            $period = HistoricalPeriod::tryFrom($request->period);
            if ($period) return $period->label();
        }
        return 'Toda la Colección';
    }
}
