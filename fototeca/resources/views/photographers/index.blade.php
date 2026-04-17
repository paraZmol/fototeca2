@extends('layouts.gallery')

@section('title', 'Fotógrafos - Fototeca Digital Ancashina')

@push('scripts')
<style>
    .photographer-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2rem;
        padding: 2rem;
        max-width: 1400px;
        margin: 0 auto;
    }
    @media (max-width: 600px) {
        .photographer-grid { grid-template-columns: 1fr; gap: 1.25rem; padding: 1.25rem; }
        .page-header { padding: 2rem 1.25rem 1rem; }
        .page-title { font-size: 1.8rem; }
        .page-desc { font-size: 0.9rem; }
    }

    .photographer-card {
        background: var(--bg-card);
        border: 1px solid var(--border-medium);
        border-radius: var(--radius-card);
        overflow: hidden;
        text-decoration: none;
        display: flex;
        flex-direction: column;
        transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
        animation: cardIn 0.5s ease both;
    }

    .photographer-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.4), 0 0 0 1px var(--wood-mid);
        border-color: var(--wood-mid);
    }

    .card-img-wrap {
        position: relative;
        aspect-ratio: 1;
        overflow: hidden;
        background: #111;
        border-bottom: 2px solid var(--wood-dark);
    }

    .card-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: sepia(0.3) contrast(1.1) brightness(0.85);
        transition: filter 0.5s ease, transform 0.5s ease;
    }

    .photographer-card:hover .card-img {
        filter: sepia(0.1) contrast(1) brightness(1);
        transform: scale(1.05);
    }

    .card-info {
        padding: 1.5rem;
        flex: 1;
        display: flex;
        flex-direction: column;
        background: linear-gradient(180deg, var(--bg-card) 0%, rgba(20,15,10,0.95) 100%);
    }

    .card-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.25rem;
        color: var(--sepia-light);
        margin-bottom: 0.5rem;
        font-weight: 700;
    }

    .card-dates {
        font-family: 'Libre Baskerville', serif;
        font-style: italic;
        font-size: 0.85rem;
        color: var(--text-accent);
        margin-bottom: 1rem;
    }

    .card-bio {
        font-size: 0.85rem;
        color: var(--text-secondary);
        line-height: 1.6;
        margin-bottom: 1.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 4;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .card-footer {
        margin-top: auto;
        padding-top: 1rem;
        border-top: 1px dashed var(--border-medium);
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.75rem;
        color: var(--text-muted);
    }

    .count-badge {
        background: rgba(201,149,106,0.15);
        color: var(--sepia-mid);
        padding: 0.2rem 0.6rem;
        border-radius: 20px;
        font-weight: 600;
        letter-spacing: 0.05em;
        border: 1px solid var(--border-subtle);
    }

    .page-header {
        padding: 3rem 2rem 1.5rem;
        text-align: center;
        max-width: 800px;
        margin: 0 auto;
        border-bottom: 1px solid var(--border-subtle);
    }

    .page-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        color: var(--text-accent);
        margin-bottom: 1rem;
        font-weight: 400;
        letter-spacing: 0.05em;
    }

    .page-desc {
        color: var(--text-secondary);
        font-size: 1rem;
        line-height: 1.7;
    }
</style>
@endpush

@section('content')
<main class="gallery-main" style="width: 100%;">
    <div class="page-header">
        <h1 class="page-title">Autores de la Memoria Visual</h1>
        <p class="page-desc">
            Conoce a los fotógrafos cuya mirada nos ha legado el patrimonio histórico de la región Ancash.
            Cada uno, con su propio estilo y época, aportó una pieza fundamental al rompecabezas de nuestra historia.
        </p>
    </div>

    <div class="photographer-grid">
        @foreach($photographers as $photographer)
        <a href="{{ route('photographers.show', $photographer->id) }}" class="photographer-card" style="animation-delay: {{ $loop->index * 0.1 }}s">
            <div class="card-img-wrap">
                <div class="photo-corner photo-corner--tl"></div>
                <div class="photo-corner photo-corner--br"></div>
                @if($photographer->portrait_path)
                    <img src="{{ $photographer->portrait_path }}" alt="{{ $photographer->name }}" class="card-img">
                @else
                    <div class="card-img" style="background: var(--bg-sidebar); display: flex; align-items: center; justify-content: center; font-size: 3rem; color: var(--border-strong);">📷</div>
                @endif
            </div>
            <div class="card-info">
                <h2 class="card-title">{{ $photographer->name }}</h2>
                <div class="card-dates">
                    {{ $photographer->birth_year ?? '?' }} — {{ $photographer->death_year ?? '?' }}
                    @if($photographer->nationality)
                    <span style="color: var(--text-muted); margin-left: 0.5rem; font-size: 0.75rem;">({{ $photographer->nationality }})</span>
                    @endif
                </div>
                <p class="card-bio">{{ $photographer->biography }}</p>
                <div class="card-footer">
                    <span>Ver colección completa</span>
                    <span class="count-badge">{{ $photographer->photos_count }} fotos</span>
                </div>
            </div>
        </a>
        @endforeach

        @if($anonymous && $anonymous->photos()->count() > 0)
        <!-- Tarjeta especial para anónimos -->
        <a href="{{ route('photographers.show', $anonymous->id) }}" class="photographer-card" style="animation-delay: {{ count($photographers) * 0.1 }}s">
            <div class="card-img-wrap" style="border-bottom-color: var(--border-medium);">
                <div class="photo-corner photo-corner--tl"></div>
                <div class="photo-corner photo-corner--br"></div>
                <div class="card-img" style="background: linear-gradient(135deg, var(--bg-sidebar), var(--bg-main)); display: flex; align-items: center; justify-content: center;">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--border-strong); filter: drop-shadow(0 4px 6px rgba(0,0,0,0.5));"><circle cx="12" cy="8" r="4"/><path d="M6 20v-2a6 6 0 0 1 12 0v2"/><path d="M3 11h2M19 11h2M12 3V1"/></svg>
                </div>
            </div>
            <div class="card-info" style="background: var(--bg-sidebar);">
                <h2 class="card-title" style="color: var(--text-muted);">{{ $anonymous->name }}</h2>
                <div class="card-dates">Múltiples hallazgos</div>
                <p class="card-bio">{{ $anonymous->biography }}</p>
                <div class="card-footer">
                    <span>Explorar archivo anónimo</span>
                    <span class="count-badge">{{ $anonymous->photos()->count() }} fotos</span>
                </div>
            </div>
        </a>
        @endif
    </div>
</main>
@endsection
