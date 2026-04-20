@extends('layouts.app')

@section('content')
<aside class="sidebar">
    <h3>Catálogo</h3>

    {{-- ── POR LUGAR ── --}}
    <div x-data="{ placeOpen: true }">
        <button @click="placeOpen = !placeOpen" class="section-header">
            <span style="display:flex;align-items:center;gap:0.4rem;"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg> Por Lugar</span>
            <x-chevron state="placeOpen" />
        </button>

        <div x-show="placeOpen" x-cloak>
            @foreach($locations as $province)
                <div x-data="{ expanded: false }">
                    <button @click="expanded = !expanded" class="accordion"
                            :class="{ 'active': expanded }"
                            style="display:flex;justify-content:space-between;align-items:center;">
                        <span>{{ $province->name }}</span>
                        <x-chevron />
                    </button>

                    <div x-show="expanded" x-cloak style="padding-left:.5rem;">
                        @foreach($province->children as $district)
                            @if($district->children->count() > 0)
                                <div x-data="{ subExpanded: false }" style="margin-top:4px;">
                                    <button @click="subExpanded = !subExpanded" class="accordion"
                                            :class="{ 'active': subExpanded }"
                                            style="font-size:.82rem;padding:.35rem .5rem;display:flex;justify-content:space-between;align-items:center;">
                                        <span>{{ $district->name }}</span>
                                        <x-chevron state="subExpanded" size="12" />
                                    </button>
                                    <div x-show="subExpanded" x-cloak style="padding-left:.9rem;">
                                        <ul style="list-style:none;padding:0;margin:2px 0;">
                                            @foreach($district->children as $neighborhood)
                                                <li style="margin-bottom:3px;">
                                                    <a href="?location={{ $neighborhood->id }}"
                                                       class="{{ request('location') == $neighborhood->id ? 'active' : '' }}"
                                                       style="font-size:.78rem;">
                                                        {{ $neighborhood->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @else
                                <div style="margin-top:4px;">
                                    <a href="?location={{ $district->id }}"
                                       class="{{ request('location') == $district->id ? 'active' : '' }}"
                                       style="font-size:.82rem;padding:.35rem .5rem;">
                                        {{ $district->name }}
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- ── POR TEMA ── --}}
    <div x-data="{ themeOpen: true }" style="margin-top:1.2rem;">
        <button @click="themeOpen = !themeOpen" class="section-header">
            <span style="display:flex;align-items:center;gap:0.4rem;"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg> Por Tema</span>
            <x-chevron state="themeOpen" />
        </button>

        <div x-show="themeOpen" x-cloak>
            @foreach($categories as $category)
                @if($category->children->count() > 0)
                    <div x-data="{ expanded: false }">
                        <button @click="expanded = !expanded" class="accordion"
                                :class="{ 'active': expanded }"
                                style="display:flex;justify-content:space-between;align-items:center;">
                            <span>{{ $category->icon }} {{ $category->name }}</span>
                            <x-chevron />
                        </button>
                        <div x-show="expanded" x-cloak style="padding-left:.9rem;">
                            <ul style="list-style:none;padding:0;margin:2px 0;">
                                @foreach($category->children as $sub)
                                    <li style="margin-bottom:3px;">
                                        <a href="?category={{ $sub->id }}"
                                           class="{{ request('category') == $sub->id ? 'active' : '' }}"
                                           style="font-size:.82rem;">
                                            {{ $sub->icon }} {{ $sub->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @else
                    <a href="?category={{ $category->id }}"
                       class="{{ request('category') == $category->id ? 'active' : '' }}"
                       style="display:block;padding:.5rem .5rem;font-size:.9rem;">
                        {{ $category->icon }} {{ $category->name }}
                    </a>
                @endif
            @endforeach
        </div>
    </div>
</aside>

<div class="content">
    {{-- Filtros de época: loop sobre el enum --}}
    <div class="top-bar">
        <a href="{{ url('/galeria') }}" class="{{ !request('period') ? 'active' : '' }}">TODO</a>
        @foreach($periods as $period)
            <a href="?{{ http_build_query(array_merge(request()->except('period'), ['period' => $period->value])) }}"
               class="{{ request('period') === $period->value ? 'active' : '' }}">
                {{ $period->barLabel() }}
            </a>
        @endforeach
    </div>

    <h2 style="margin-top:0;color:var(--text-oscuro);">{{ $pageTitle }}</h2>

    <div class="gallery-grid">
        @forelse($photos as $photo)
            <article class="photo-card">
                <img src="{{ $photo->image_src }}" loading="lazy" alt="{{ $photo->title }}">
                <div class="photo-info">
                    <h4>{{ $photo->title }}</h4>
                    <p>
                        <strong>{{ $photo->year_label }}</strong>
                        @if($photo->photographers->isNotEmpty())
                            &nbsp;·&nbsp; {{ $photo->photographers->map->display_name->join(', ') }}
                        @endif
                    </p>
                    @if($photo->source_archive)
                        <p style="font-size:.75rem;opacity:.65;margin-top:.3rem;">{{ $photo->source_archive }}</p>
                    @endif
                </div>
            </article>
        @empty
            <p style="grid-column:1/-1;color:var(--text-oscuro);opacity:.6;">
                No se encontraron fotografías con los filtros seleccionados.
            </p>
        @endforelse
    </div>

    <div style="margin-top:2rem;">
        {{ $photos->links() }}
    </div>
</div>
@endsection
