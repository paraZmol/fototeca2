@extends('layouts.gallery')

@section('title', 'Galería · Fototeca Digital Ancashina')

@section('content')
{{-- ═══════════════════════════════════════════
     SIDEBAR IZQUIERDO  
     ═══════════════════════════════════════════ --}}
<aside class="sidebar" id="sidebar">

    {{-- logo / cabecera del sidebar --}}
    <div class="sidebar-header">
        <div class="sidebar-logo">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
            </svg>
        </div>
        <div>
            <p class="sidebar-title-text">FOTOTECA</p>
            <p class="sidebar-subtitle-text">Ancash Digital</p>
        </div>
        <button class="sidebar-close-btn" id="sidebarClose" aria-label="Cerrar menú">✕</button>
    </div>

    {{-- buscador integrado en sidebar --}}
    <form method="GET" action="{{ route('galeria') }}" class="sidebar-search-form">
        <div class="sidebar-search-wrap">
            <svg class="sidebar-search-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
            </svg>
            <input type="text" name="q" value="{{ request('q') }}" 
                   placeholder="Buscar fotografías..." 
                   class="sidebar-search-input" id="search-input" autocomplete="off">
        </div>
    </form>

    {{-- ─── CATÁLOGO GEOGRÁFICO ─── --}}
    <div class="sidebar-section">
        <h4 class="sidebar-section-label">
            <svg class="sidebar-section-icon" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg> Catálogo Geográfico
        </h4>

        @foreach($provinces as $province)
        <div x-data="{ open: {{ request('location') && in_array(request('location'), array_merge([$province->id], $province->allChildren->pluck('id')->flatten()->all())) ? 'true' : 'false' }} }" class="accordion-group">

            {{-- provincia: solo boton de acordeon --}}
            <button @click="open = !open" class="accordion-btn" :class="{'accordion-btn--open': open}">
                <svg class="accordion-icon" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="3 6 9 3 15 6 21 3 21 18 15 21 9 18 3 21"/><line x1="9" y1="3" x2="9" y2="18"/><line x1="15" y1="6" x2="15" y2="21"/></svg>
                <span class="accordion-btn-text">{{ $province->name }}</span>
                <svg class="accordion-chevron" :class="{'rotated': open}" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <polyline points="6 9 12 15 18 9"/>
                </svg>
            </button>

            <div x-show="open" x-cloak class="accordion-panel" x-transition:enter="accordion-enter" x-transition:enter-start="accordion-enter-start" x-transition:enter-end="accordion-enter-end">
                @foreach($province->children as $district)
                <div x-data="{ subOpen: {{ request('location') && in_array(request('location'), array_merge([$district->id], $district->children->pluck('id')->all())) ? 'true' : 'false' }} }" class="accordion-group sub">

                    @if($district->children->count() > 0)
                        {{-- distrito con barrios: boton acordeon --}}
                        <button @click="subOpen = !subOpen" class="accordion-btn accordion-btn--sub" :class="{'accordion-btn--open': subOpen}">
                            <svg class="accordion-icon" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                            <span class="accordion-btn-text">{{ $district->name }}</span>
                            <svg class="accordion-chevron" :class="{'rotated': subOpen}" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <polyline points="6 9 12 15 18 9"/>
                            </svg>
                        </button>
                        <div x-show="subOpen" x-cloak class="accordion-panel">
                            @foreach($district->children as $neighborhood)
                            <a href="{{ route('galeria', array_merge(request()->except(['location','page']), ['location' => $neighborhood->id])) }}"
                               class="sidebar-leaf {{ request('location') == $neighborhood->id ? 'sidebar-leaf--active' : '' }}">
                                <span class="leaf-dot"></span>{{ $neighborhood->name }}
                            </a>
                            @endforeach
                        </div>
                    @else
                        {{-- distrito sin barrios: enlace directo --}}
                        <a href="{{ route('galeria', array_merge(request()->except(['location','page']), ['location' => $district->id])) }}"
                           class="accordion-btn accordion-btn--sub {{ request('location') == $district->id ? 'accordion-btn--open' : '' }}" style="text-decoration:none;">
                            <svg class="accordion-icon" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="2"/></svg>
                            <span class="accordion-btn-text">{{ $district->name }}</span>
                        </a>
                    @endif

                </div>
                @endforeach
            </div>

        </div>
        @endforeach
    </div>

    {{-- ─── CATEGORÍAS TEMÁTICAS ─── --}}
    <div class="sidebar-section" style="margin-top: 1.5rem;">
        <h4 class="sidebar-section-label">
            <svg class="sidebar-section-icon" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg> Categorías Temáticas
        </h4>

        @foreach($rootCategories as $rootCat)
        <div x-data="{ open: {{ request('category') && ($rootCat->id == request('category') || $rootCat->children->contains('id', request('category'))) ? 'true' : 'false' }} }" class="accordion-group">

            @if($rootCat->children->count() > 0)
                <button @click="open = !open" class="accordion-btn" :class="{'accordion-btn--open': open}">
                    <svg class="accordion-icon" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
                    <span class="accordion-btn-text">{{ $rootCat->name }}</span>
                    <svg class="accordion-chevron" :class="{'rotated': open}" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="6 9 12 15 18 9"/>
                    </svg>
                </button>
                <div x-show="open" x-cloak class="accordion-panel">
                    @foreach($rootCat->children as $child)
                        @if($child->subcategories->count() > 0)
                        <div x-data="{ subOpen: {{ request('subcategory') && $child->subcategories->contains('id', request('subcategory')) ? 'true' : 'false' }} }" class="accordion-group sub">
                            <button @click="subOpen = !subOpen" class="accordion-btn accordion-btn--sub" :class="{'accordion-btn--open': subOpen}">
                                <span style="margin-right:4px;opacity:0.5;">›</span>
                                <span class="accordion-btn-text">{{ $child->name }}</span>
                                <svg class="accordion-chevron" :class="{'rotated': subOpen}" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <polyline points="6 9 12 15 18 9"/>
                                </svg>
                            </button>
                            <div x-show="subOpen" x-cloak class="accordion-panel">
                                @foreach($child->subcategories as $sub)
                                <a href="{{ route('galeria', array_merge(request()->except(['subcategory','category','page']), ['subcategory' => $sub->id])) }}"
                                   class="sidebar-leaf {{ request('subcategory') == $sub->id ? 'sidebar-leaf--active' : '' }}">
                                    <span class="leaf-dot"></span>{{ $sub->name }}
                                </a>
                                @endforeach
                            </div>
                        </div>
                        @else
                        <a href="{{ route('galeria', array_merge(request()->except(['category','subcategory','page']), ['category' => $child->id])) }}"
                           class="sidebar-leaf {{ request('category') == $child->id ? 'sidebar-leaf--active' : '' }}">
                            <span style="margin-right:4px;opacity:0.5;">›</span>{{ $child->name }}
                        </a>
                        @endif
                    @endforeach
                </div>
            @else
                <a href="{{ route('galeria', array_merge(request()->except(['category','subcategory','page']), ['category' => $rootCat->id])) }}"
                   class="accordion-btn {{ request('category') == $rootCat->id ? 'accordion-btn--open' : '' }}" style="text-decoration:none;">
                    <svg class="accordion-icon" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
                    <span class="accordion-btn-text">{{ $rootCat->name }}</span>
                </a>
            @endif

        </div>
        @endforeach
    </div>

    {{-- footer del sidebar --}}
    <div class="sidebar-footer">
        <p>Archivo Histórico Ancashino</p>
        <p>{{ $photos->total() }} fotografías catalogadas</p>
    </div>
</aside>

{{-- ═══════════════════════════════════════════
     ÁREA PRINCIPAL DE GALERÍA  
     ═══════════════════════════════════════════ --}}
<main class="gallery-main">

    {{-- barra superior de filtros especiales (periodos historicos) --}}
    <header class="topbar">
        <div class="topbar-left">
            <button class="hamburger-btn" id="hamburgerBtn" aria-label="Abrir menú">
                <span></span><span></span><span></span>
            </button>
            <div class="topbar-breadcrumb">
                <span class="topbar-breadcrumb-home">Fototeca</span>
                <span class="topbar-breadcrumb-sep">›</span>
                <span class="topbar-breadcrumb-current">{{ $activeLabel }}</span>
            </div>
        </div>

        <div class="topbar-filters">
            <a href="{{ route('galeria', request()->except(['period','page'])) }}"
               class="filter-pill {{ !request('period') ? 'filter-pill--active' : '' }}">
               TODAS
            </a>
            @foreach($periods as $period)
            <a href="{{ route('galeria', array_merge(request()->except(['period','page']), ['period' => $period->value])) }}"
               class="filter-pill {{ request('period') === $period->value ? 'filter-pill--active' : '' }}">
                {{ $period->barLabel() }}
            </a>
            @endforeach
        </div>

        {{-- limpiar filtros --}}
        @if(request()->has('location') || request()->has('category') || request()->has('subcategory') || request()->has('period') || request()->has('q'))
        <a href="{{ route('galeria') }}" class="clear-filters-btn">
            ✕ Limpiar filtros
        </a>
        @endif
    </header>

    {{-- titulo contextual de la coleccion --}}
    <div class="gallery-context-bar">
        <div class="gallery-context-line"></div>
        <h2 class="gallery-context-title">{{ $activeLabel }}</h2>
        <div class="gallery-context-count">{{ $photos->total() }} resultado(s)</div>
        <div class="gallery-context-line"></div>
    </div>

    {{-- grid de fotografias --}}
    @if($photos->count() > 0)
    <div class="photo-grid" id="photo-grid">
        @foreach($photos as $photo)
        <article class="photo-card" data-period="{{ $photo->historical_period?->value }}" style="animation-delay: {{ $loop->index * 0.04 }}s">
            <div class="photo-card-inner">
                <div class="photo-card-img-wrap">
                    <img src="{{ $photo->image_src }}"
                         alt="{{ $photo->title }}"
                         class="photo-card-img"
                         loading="lazy">

                    {{-- overlay con info al hover --}}
                    <div class="photo-card-overlay">
                        <div class="photo-card-overlay-content">
                            <p class="overlay-year">{{ $photo->year_label }}</p>
                            @if($photo->location)
                            <p class="overlay-location">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                                {{ $photo->location->name }}
                            </p>
                            @endif
                            @if($photo->historical_period)
                            <span class="overlay-period-tag">{{ $photo->historical_period->label() }}</span>
                            @endif
                        </div>
                    </div>

                    {{-- marco decorativo de esquina tipo archivo --}}
                    <div class="photo-corner photo-corner--tl"></div>
                    <div class="photo-corner photo-corner--br"></div>
                </div>

                <div class="photo-card-info">
                    <h3 class="photo-card-title">{{ $photo->title }}</h3>
                    <div class="photo-card-meta">
                        @if($photo->photographers->count())
                        <span class="meta-photographer">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="currentColor"><path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/></svg>
                            {{ $photo->photographers->first()->display_name }}
                        </span>
                        @endif
                        <span class="meta-categories">
                            @foreach($photo->categories->take(2) as $cat)
                            <span class="cat-badge">{{ $cat->icon ?? '' }} {{ $cat->name }}</span>
                            @endforeach
                        </span>
                    </div>
                </div>
            </div>
        </article>
        @endforeach
    </div>

    {{-- paginacion --}}
    @if($photos->hasPages())
    <div class="pagination-wrap">
        {{ $photos->links('pagination::simple-bootstrap-4') }}
    </div>
    @endif

    @else
    {{-- estado vacio --}}
    <div class="empty-state">
        <div class="empty-icon"><svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="5" rx="1"/><rect x="2" y="10" width="20" height="5" rx="1"/><rect x="2" y="17" width="20" height="5" rx="1"/><line x1="6" y1="5.5" x2="6.01" y2="5.5"/><line x1="6" y1="12.5" x2="6.01" y2="12.5"/><line x1="6" y1="19.5" x2="6.01" y2="19.5"/></svg></div>
        <h3 class="empty-title">Sin resultados</h3>
        <p class="empty-desc">No se encontraron fotografías con los filtros aplicados.</p>
        <a href="{{ route('galeria') }}" class="empty-btn">Explorar toda la colección</a>
    </div>
    @endif

</main>

{{-- lightbox modal --}}
<div class="lightbox-modal" id="lightboxModal">
    <button class="lightbox-close" id="lightboxClose">&times;</button>
    <button class="lightbox-nav lightbox-prev" id="lightboxPrev">‹</button>
    <button class="lightbox-nav lightbox-next" id="lightboxNext">›</button>

    <div class="lightbox-container">
        <div class="lightbox-left">
            <img src="" class="lightbox-content" id="lightboxImg">
        </div>
        <div class="lightbox-right">
            <div class="lightbox-details-wrap">
                <h3 class="lightbox-title" id="lightboxTitle"></h3>
                <div class="lightbox-meta-block">
                    <div class="lightbox-meta-item" id="lightboxPhotographer"></div>
                    <div class="lightbox-meta-item" id="lightboxYear"></div>
                    <div class="lightbox-meta-item" id="lightboxLocation"></div>
                    <div class="lightbox-meta-item" id="lightboxCategories"></div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- overlay oscuro para sidebar en movil --}}
<div class="sidebar-overlay" id="sidebarOverlay"></div>
@endsection

@push('scripts')
<style>
.photo-card { cursor: pointer; }
.lightbox-modal {
    display: none;
    position: fixed;
    z-index: 9999;
    top: 0; left: 0; width: 100%; height: 100%;
    background: rgba(10, 5, 2, 0.95);
    align-items: center;
    justify-content: center;
}
.lightbox-modal.active { display: flex; animation: fadeIn 0.3s ease; }

.lightbox-container {
    display: flex;
    width: 90vw;
    height: 85vh;
    background: var(--bg-card, #1c1510);
    border: 1px solid var(--wood-mid, #5c3a21);
    box-shadow: 0 20px 50px rgba(0,0,0,0.9);
    border-radius: var(--radius-card);
    overflow: hidden;
}

.lightbox-left {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #0d0a08;
    position: relative;
    padding: 1rem;
    overflow: hidden;
}

.lightbox-content {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    box-shadow: 0 5px 25px rgba(0,0,0,0.8);
    cursor: zoom-in;
    will-change: transform;
    transition: transform 0.1s ease-out;
}

.lightbox-right {
    width: 380px;
    background: linear-gradient(180deg, var(--bg-card) 0%, rgba(20,15,10,0.95) 100%);
    border-left: 2px solid var(--wood-dark);
    padding: 2.5rem 2rem;
    display: flex;
    flex-direction: column;
    overflow-y: auto;
}

.lightbox-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.5rem;
    color: var(--sepia-light);
    margin-bottom: 2rem;
    line-height: 1.3;
    border-bottom: 1px dashed var(--border-medium);
    padding-bottom: 1.5rem;
}

.lightbox-meta-block {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.lightbox-meta-item {
    font-size: 0.95rem;
    color: var(--text-secondary);
}

.lightbox-meta-item strong {
    display: block;
    color: var(--text-muted);
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 0.4rem;
}

.lightbox-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(20, 15, 10, 0.7);
    color: var(--sepia-mid);
    border: 1px solid var(--wood-mid);
    width: 55px;
    height: 55px;
    border-radius: 50%;
    font-size: 35px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
    z-index: 10;
}
.lightbox-nav:hover { background: var(--wood-mid); color: #fff; }
.lightbox-prev { left: 2vw; }
.lightbox-next { right: 2vw; }

.lightbox-close {
    position: absolute;
    top: 15px;
    right: 20px;
    color: var(--text-muted);
    font-size: 40px;
    background: none;
    border: none;
    cursor: pointer;
    line-height: 1;
    z-index: 10;
    transition: color 0.3s;
}
.lightbox-close:hover { color: #fff; }

@media (max-width: 900px) {
    .lightbox-container { flex-direction: column; width: 95vw; height: 90vh; }
    .lightbox-right { width: 100%; border-left: none; border-top: 2px solid var(--wood-dark); padding: 1.5rem; }
}
@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
</style>
<script>
// control del sidebar en movil
const sidebarClose  = document.getElementById('sidebarClose');
const sidebar       = document.getElementById('sidebar');
const overlay       = document.getElementById('sidebarOverlay');

function openSidebar() {
    sidebar.classList.add('sidebar--open');
    overlay.classList.add('overlay--visible');
    document.body.style.overflow = 'hidden';
}

function closeSidebar() {
    sidebar.classList.remove('sidebar--open');
    overlay.classList.remove('overlay--visible');
    document.body.style.overflow = '';
}

// lightbox vars
let currentCards = [];
let currentIndex = -1;
const lightboxModal = document.getElementById('lightboxModal');

function openLightbox(index) {
    if (index < 0 || index >= currentCards.length) return;
    currentIndex = index;
    const card = currentCards[currentIndex];
    
    // reset zoom
    scale = 1; pointX = 0; pointY = 0;
    setTransform();
    lightboxImg.style.cursor = 'zoom-in';
    
    // visibilidad de flechas
    document.getElementById('lightboxPrev').style.display = (index === 0) ? 'none' : 'flex';
    document.getElementById('lightboxNext').style.display = (index === currentCards.length - 1) ? 'none' : 'flex';
    
    const img = card.querySelector('.photo-card-img')?.src || '';
    const title = card.querySelector('.photo-card-title')?.innerHTML || '';
    const year = card.querySelector('.overlay-year')?.innerHTML || '';
    const loc = card.querySelector('.overlay-location')?.innerHTML || '';
    const photog = card.querySelector('.meta-photographer')?.innerHTML || '';
    const cats = card.querySelector('.meta-categories')?.innerHTML || '';
    
    document.getElementById('lightboxImg').src = img;
    document.getElementById('lightboxTitle').innerHTML = title;
    
    document.getElementById('lightboxPhotographer').innerHTML = photog ? `<strong>Fotógrafo(s)</strong>${photog}` : '';
    document.getElementById('lightboxYear').innerHTML = year ? `<strong>Fecha</strong>${year}` : '';
    document.getElementById('lightboxLocation').innerHTML = loc ? `<strong>Ubicación</strong>${loc}` : '';
    document.getElementById('lightboxCategories').innerHTML = cats ? `<strong>Categorías</strong>${cats}` : '';
    
    lightboxModal.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    lightboxModal.classList.remove('active');
    document.body.style.overflow = '';
}

document.getElementById('lightboxClose')?.addEventListener('click', closeLightbox);
lightboxModal?.addEventListener('click', function(e) {
    if (e.target === lightboxModal) { closeLightbox(); }
});

// delegacion global (lightbox, navegacion y hamburguesa)
document.addEventListener('click', function(e) {
    if (e.target.closest('#hamburgerBtn')) openSidebar();
    
    if (e.target.closest('#lightboxPrev')) openLightbox(currentIndex - 1);
    if (e.target.closest('#lightboxNext')) openLightbox(currentIndex + 1);
    
    const card = e.target.closest('.photo-card');
    if (card) {
        currentCards = Array.from(document.querySelectorAll('.photo-card'));
        const index = currentCards.indexOf(card);
        openLightbox(index);
    }
});

// navegacion con teclado
document.addEventListener('keydown', function(e) {
    if (lightboxModal.classList.contains('active')) {
        if (e.key === 'ArrowLeft') openLightbox(currentIndex - 1);
        if (e.key === 'ArrowRight') openLightbox(currentIndex + 1);
        if (e.key === 'Escape') closeLightbox();
    }
});

sidebarClose?.addEventListener('click', closeSidebar);
overlay?.addEventListener('click', closeSidebar);

// zoom y pan en imagen
let scale = 1, panning = false, pointX = 0, pointY = 0, startX = 0, startY = 0;

function setTransform() {
    lightboxImg.style.transform = `translate(${pointX}px, ${pointY}px) scale(${scale})`;
}

document.getElementById('lightboxImg')?.addEventListener('mousedown', function(e) {
    if (scale > 1) {
        e.preventDefault();
        startX = e.clientX - pointX;
        startY = e.clientY - pointY;
        panning = true;
        lightboxImg.style.transition = 'none';
        lightboxImg.style.cursor = 'grabbing';
    }
});

document.addEventListener('mouseup', function() {
    if (!panning) return;
    panning = false;
    lightboxImg.style.transition = 'transform 0.1s ease-out';
    if(scale > 1) lightboxImg.style.cursor = 'grab';
});

document.addEventListener('mousemove', function(e) {
    if (!panning) return;
    e.preventDefault();
    pointX = e.clientX - startX;
    pointY = e.clientY - startY;
    setTransform();
});

document.getElementById('lightboxImg')?.addEventListener('wheel', function(e) {
    e.preventDefault();
    scale += e.deltaY * -0.005;
    scale = Math.max(1, Math.min(scale, 5));
    if (scale === 1) {
        pointX = 0; pointY = 0;
        lightboxImg.style.cursor = 'zoom-in';
    } else {
        lightboxImg.style.cursor = 'grab';
    }
    lightboxImg.style.transition = 'none';
    setTransform();
});

document.getElementById('lightboxImg')?.addEventListener('dblclick', function(e) {
    e.preventDefault();
    if (scale > 1) {
        scale = 1; pointX = 0; pointY = 0;
        lightboxImg.style.cursor = 'zoom-in';
    } else {
        scale = 2.5; pointX = 0; pointY = 0;
        lightboxImg.style.cursor = 'grab';
    }
    lightboxImg.style.transition = 'transform 0.2s ease-out';
    setTransform();
});

// busqueda en tiempo real
let searchTimeout;
const searchInput = document.getElementById('search-input');
const galleryMain = document.querySelector('.gallery-main');

if (searchInput) {
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            const url = new URL(window.location.href);
            if (this.value.trim() === '') {
                url.searchParams.delete('q');
            } else {
                url.searchParams.set('q', this.value);
            }
            url.searchParams.delete('page');
            window.history.pushState({}, '', url);

            fetch(url)
            .then(res => res.text())
            .then(html => {
                const doc = new DOMParser().parseFromString(html, 'text/html');
                const newMain = doc.querySelector('.gallery-main');
                if (newMain) {
                    galleryMain.innerHTML = newMain.innerHTML;
                }
            });
        }, 300);
    });
}
</script>
@endpush
