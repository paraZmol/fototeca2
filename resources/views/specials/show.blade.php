@extends('layouts.gallery')

@section('title', $collection->name . ' · Fototeca Digital Ancashina')

@section('content')
<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo">
            <span style="font-size:22px;">{{ $collection->icon }}</span>
        </div>
        <div>
            <p class="sidebar-title-text">ESPECIALES</p>
            <p class="sidebar-subtitle-text">Colección</p>
        </div>
        <button class="sidebar-close-btn" id="sidebarClose" aria-label="Cerrar menú">✕</button>
    </div>

    <div class="sidebar-section">
        <h4 class="sidebar-section-label">{{ $collection->name }}</h4>

        {{-- enlaces a sub-colecciones --}}
        @foreach($collection->children as $child)
        <div x-data="{ open: false }" class="accordion-group">
            @if($child->children->count() > 0)
                <button @click="open = !open" class="accordion-btn" :class="{'accordion-btn--open': open}">
                    <span style="font-size:14px;margin-right:4px;">{{ $child->icon }}</span>
                    <span class="accordion-btn-text">{{ $child->name }}</span>
                    <svg class="accordion-chevron" :class="{'rotated': open}" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                </button>
                <div x-show="open" x-cloak class="accordion-panel">
                    @foreach($child->children as $grandchild)
                    <a href="{{ route('galeria', ['category' => $grandchild->id]) }}"
                       class="sidebar-leaf">
                        <span class="leaf-dot"></span>{{ $grandchild->name }}
                    </a>
                    @endforeach
                </div>
            @else
                <a href="{{ route('galeria', ['category' => $child->id]) }}"
                   class="accordion-btn" style="text-decoration:none;">
                    <span style="font-size:14px;margin-right:4px;">{{ $child->icon }}</span>
                    <span class="accordion-btn-text">{{ $child->name }}</span>
                </a>
            @endif
        </div>
        @endforeach

        <a href="{{ route('specials.index') }}" class="sidebar-leaf" style="margin-top:1rem;">
            ← Todas las colecciones
        </a>
        <a href="{{ route('galeria') }}" class="sidebar-leaf">
            ← Galería completa
        </a>
    </div>

    <div class="sidebar-footer">
        <p>{{ $photos->total() }} fotografías</p>
    </div>
</aside>

<main class="gallery-main">
    <header class="topbar">
        <div class="topbar-left">
            <button class="hamburger-btn" id="hamburgerBtn" aria-label="Abrir menú">
                <span></span><span></span><span></span>
            </button>
            <div class="topbar-breadcrumb">
                <a href="{{ route('home') }}" class="topbar-breadcrumb-home">Fototeca</a>
                <span class="topbar-breadcrumb-sep">›</span>
                <a href="{{ route('specials.index') }}" class="topbar-breadcrumb-home">Especiales</a>
                <span class="topbar-breadcrumb-sep">›</span>
                <span class="topbar-breadcrumb-current">{{ $collection->name }}</span>
            </div>
        </div>
    </header>

    <div class="gallery-context-bar">
        <div class="gallery-context-line"></div>
        <h1 class="gallery-context-title">{{ $collection->icon }} {{ $collection->name }}</h1>
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
                        @if($photo->provider)
                        <span class="meta-categories">
                            <span class="cat-badge">📁 {{ $photo->provider }}</span>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </article>
        @endforeach
    </div>

    @if($photos->hasPages())
    <div class="pagination-wrap">
        {{ $photos->links('pagination::simple-bootstrap-4') }}
    </div>
    @endif

    @else
    <div class="empty-state">
        <div class="empty-icon"><svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></div>
        <h3 class="empty-title">Colección vacía</h3>
        <p class="empty-desc">Esta colección especial aún no tiene fotografías catalogadas.</p>
        <a href="{{ route('specials.index') }}" class="empty-btn">Ver otras colecciones</a>
    </div>
    @endif
</main>

<div class="lightbox-modal" id="lightboxModal">
    <button class="lightbox-close" id="lightboxClose">&times;</button>
    <button class="lightbox-nav lightbox-prev" id="lightboxPrev">‹</button>
    <button class="lightbox-nav lightbox-next" id="lightboxNext">›</button>
    <div class="lightbox-container">
        <div class="lightbox-left"><img src="" class="lightbox-content" id="lightboxImg"></div>
        <div class="lightbox-right">
            <div class="lightbox-details-wrap">
                <h3 class="lightbox-title" id="lightboxTitle"></h3>
                <div class="lightbox-meta-block">
                    <div class="lightbox-meta-item" id="lightboxPhotographer"></div>
                    <div class="lightbox-meta-item" id="lightboxYear"></div>
                    <div class="lightbox-meta-item" id="lightboxLocation"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="sidebar-overlay" id="sidebarOverlay"></div>
@endsection

@push('scripts')
<script>
const sidebarClose = document.getElementById('sidebarClose');
const sidebar      = document.getElementById('sidebar');
const overlay      = document.getElementById('sidebarOverlay');
const lightboxModal = document.getElementById('lightboxModal');
let currentCards = [], currentIndex = -1;

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
function openLightbox(index) {
    if (index < 0 || index >= currentCards.length) return;
    currentIndex = index;
    const card = currentCards[index];
    const img   = card.querySelector('.photo-card-img')?.src || '';
    const title = card.querySelector('.photo-card-title')?.innerHTML || '';
    const year  = card.querySelector('.overlay-year')?.innerHTML || '';
    const loc   = card.querySelector('.overlay-location')?.innerHTML || '';
    const photog = card.querySelector('.meta-photographer')?.innerHTML || '';
    document.getElementById('lightboxImg').src = img;
    document.getElementById('lightboxTitle').innerHTML = title;
    document.getElementById('lightboxPhotographer').innerHTML = photog ? `<strong>Fotógrafo(s)</strong>${photog}` : '';
    document.getElementById('lightboxYear').innerHTML = year ? `<strong>Fecha</strong>${year}` : '';
    document.getElementById('lightboxLocation').innerHTML = loc ? `<strong>Ubicación</strong>${loc}` : '';
    document.getElementById('lightboxPrev').style.display = (index === 0) ? 'none' : 'flex';
    document.getElementById('lightboxNext').style.display = (index === currentCards.length - 1) ? 'none' : 'flex';
    lightboxModal.classList.add('active');
    document.body.style.overflow = 'hidden';
}
function closeLightbox() {
    lightboxModal.classList.remove('active');
    document.body.style.overflow = '';
}

document.getElementById('lightboxClose')?.addEventListener('click', closeLightbox);
lightboxModal?.addEventListener('click', e => { if (e.target === lightboxModal) closeLightbox(); });
document.addEventListener('click', function(e) {
    if (e.target.closest('#hamburgerBtn')) openSidebar();
    if (e.target.closest('#lightboxPrev')) openLightbox(currentIndex - 1);
    if (e.target.closest('#lightboxNext')) openLightbox(currentIndex + 1);
    const card = e.target.closest('.photo-card');
    if (card) {
        currentCards = Array.from(document.querySelectorAll('.photo-card'));
        openLightbox(currentCards.indexOf(card));
    }
});
document.addEventListener('keydown', e => {
    if (!lightboxModal.classList.contains('active')) return;
    if (e.key === 'ArrowLeft') openLightbox(currentIndex - 1);
    if (e.key === 'ArrowRight') openLightbox(currentIndex + 1);
    if (e.key === 'Escape') closeLightbox();
});
sidebarClose?.addEventListener('click', closeSidebar);
overlay?.addEventListener('click', closeSidebar);
</script>
@endpush
