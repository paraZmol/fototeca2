@extends('layouts.gallery')

@section('title', 'Colecciones Especiales · Fototeca Digital Ancashina')

@section('content')
<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
            </svg>
        </div>
        <div>
            <p class="sidebar-title-text">ESPECIALES</p>
            <p class="sidebar-subtitle-text">Colecciones</p>
        </div>
        <button class="sidebar-close-btn" id="sidebarClose" aria-label="Cerrar menú">✕</button>
    </div>

    <div class="sidebar-section">
        <h4 class="sidebar-section-label">
            <svg class="sidebar-section-icon" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            Colecciones
        </h4>

        @foreach($specials as $collection)
        <a href="{{ route('specials.show', $collection->slug) }}"
           class="accordion-btn" style="text-decoration:none;">
            <span style="font-size:16px;margin-right:6px;">{{ $collection->icon }}</span>
            <span class="accordion-btn-text">{{ $collection->name }}</span>
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
        </a>
        @endforeach

        <a href="{{ route('galeria') }}" class="sidebar-leaf" style="margin-top:1rem;">
            ← Volver a la Galería
        </a>
    </div>

    <div class="sidebar-footer">
        <p>Archivo Histórico Ancashino</p>
        <p>Colecciones Especiales</p>
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
                <span class="topbar-breadcrumb-current">Especiales</span>
            </div>
        </div>
    </header>

    <div class="gallery-context-bar">
        <div class="gallery-context-line"></div>
        <h1 class="gallery-context-title">Colecciones Especiales</h1>
        <div class="gallery-context-count">{{ $specials->count() }} colecciones</div>
        <div class="gallery-context-line"></div>
    </div>

    {{-- grid de colecciones especiales --}}
    <div class="specials-grid">
        @foreach($specials as $collection)
        <a href="{{ route('specials.show', $collection->slug) }}" class="special-card" id="special-{{ $collection->slug }}">
            <div class="special-card-icon">{{ $collection->icon }}</div>
            <div class="special-card-body">
                <h2 class="special-card-title">{{ $collection->name }}</h2>
                <ul class="special-card-sub">
                    @foreach($collection->children->take(5) as $child)
                    <li>{{ $child->icon }} {{ $child->name }}</li>
                    @endforeach
                    @if($collection->children->count() > 5)
                    <li style="opacity:0.6;font-style:italic;">y {{ $collection->children->count() - 5 }} más...</li>
                    @endif
                </ul>
                <span class="special-card-cta">Explorar colección →</span>
            </div>
        </a>
        @endforeach
    </div>
</main>

<div class="sidebar-overlay" id="sidebarOverlay"></div>
@endsection

@push('scripts')
<style>
.specials-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
    gap: 1.5rem;
    padding: 2rem;
}

.special-card {
    display: flex;
    gap: 1.25rem;
    background: var(--bg-card, #1c1510);
    border: 1px solid var(--border-medium, rgba(122,82,54,0.3));
    border-radius: var(--radius-card, 8px);
    padding: 1.75rem;
    text-decoration: none;
    color: inherit;
    transition: border-color 0.3s, box-shadow 0.3s, transform 0.2s;
    cursor: pointer;
}

.special-card:hover {
    border-color: var(--gold-mid, #c9a84c);
    box-shadow: 0 8px 30px rgba(0,0,0,0.5);
    transform: translateY(-3px);
}

.special-card-icon {
    font-size: 2.5rem;
    flex-shrink: 0;
    line-height: 1;
    margin-top: 0.25rem;
}

.special-card-body {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.special-card-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.2rem;
    color: var(--sepia-light, #d4b896);
    line-height: 1.3;
    margin: 0;
}

.special-card-sub {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 0.3rem;
}

.special-card-sub li {
    font-size: 0.8rem;
    color: var(--text-secondary, rgba(212,184,150,0.7));
}

.special-card-cta {
    font-size: 0.78rem;
    color: var(--gold-mid, #c9a84c);
    margin-top: auto;
    letter-spacing: 0.03em;
}

@media (max-width: 768px) {
    .specials-grid { grid-template-columns: 1fr; padding: 1rem; }
}
</style>
<script>
const sidebarClose = document.getElementById('sidebarClose');
const sidebar      = document.getElementById('sidebar');
const overlay      = document.getElementById('sidebarOverlay');

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

document.addEventListener('click', function(e) {
    if (e.target.closest('#hamburgerBtn')) openSidebar();
});

sidebarClose?.addEventListener('click', closeSidebar);
overlay?.addEventListener('click', closeSidebar);
</script>
@endpush
