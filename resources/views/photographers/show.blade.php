@extends('layouts.gallery')

@section('title', $photographer->full_name . ' · Fototeca Digital Ancashina')

@push('scripts')
<style>
    .profile-header {
        display: flex;
        gap: 3rem;
        padding: 3rem;
        background: var(--bg-card);
        border-bottom: 1px solid var(--border-subtle);
        align-items: flex-start;
        position: relative;
    }

    @media (max-width: 768px) {
        .profile-header { flex-direction: column; padding: 2rem; gap: 1.5rem; }
        .profile-avatar-wrap { width: 160px; height: 160px; }
        .profile-name { font-size: 1.8rem; }
        .back-btn { position: static; margin-bottom: 0.5rem; }
        .profile-stats { flex-wrap: wrap; gap: 1rem; }
    }
    @media (max-width: 480px) {
        .profile-header { padding: 1.25rem; }
        .profile-avatar-wrap { width: 120px; height: 120px; }
        .profile-name { font-size: 1.5rem; }
        .profile-bio { font-size: 0.88rem; }
    }

    .profile-avatar-wrap {
        width: 220px;
        height: 220px;
        flex-shrink: 0;
        border-radius: var(--radius-card);
        overflow: hidden;
        border: 1px solid var(--border-medium);
        position: relative;
    }

    .profile-avatar {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: sepia(0.2) contrast(1.1);
    }

    .profile-info { flex: 1; }

    .profile-name {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        color: var(--sepia-light);
        margin-bottom: 0.5rem;
        font-weight: 700;
        line-height: 1.1;
    }

    .profile-meta {
        font-family: 'Libre Baskerville', serif;
        font-style: italic;
        color: var(--text-accent);
        font-size: 0.95rem;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .profile-meta-sep { opacity: 0.4; }

    .profile-dates-block {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.75rem 2rem;
        margin-bottom: 1.5rem;
        padding: 1rem 1.25rem;
        background: rgba(0,0,0,0.25);
        border-radius: 6px;
        border: 1px solid var(--border-subtle);
        max-width: 500px;
        font-size: 0.82rem;
    }

    .profile-dates-item {
        display: flex;
        flex-direction: column;
        gap: 0.15rem;
    }

    .profile-dates-label {
        font-size: 0.67rem;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--text-muted);
    }

    .profile-dates-value {
        color: var(--text-secondary);
    }

    .profile-bio {
        font-size: 0.92rem;
        line-height: 1.85;
        color: var(--text-secondary);
        max-width: 780px;
        margin-bottom: 1.5rem;
    }

    .profile-critique {
        font-size: 0.88rem;
        line-height: 1.75;
        color: var(--text-muted);
        font-style: italic;
        padding: 1rem 1.25rem;
        border-left: 3px solid var(--wood-mid);
        margin-bottom: 1.5rem;
        max-width: 780px;
        background: rgba(122,82,54,0.08);
        border-radius: 0 4px 4px 0;
    }

    .profile-critique-label {
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: var(--text-accent);
        margin-bottom: 0.5rem;
        font-style: normal;
        font-weight: 600;
    }

    .profile-stats {
        display: flex;
        gap: 1.5rem;
        border-top: 1px dashed var(--border-medium);
        padding-top: 1.5rem;
        max-width: 780px;
    }

    .stat-item {
        display: flex;
        flex-direction: column;
        color: var(--text-muted);
    }

    .stat-value {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--sepia-light);
        font-family: 'Playfair Display', serif;
        line-height: 1;
    }

    .stat-label {
        font-size: 0.66rem;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        margin-top: 0.25rem;
    }

    .back-btn {
        position: absolute;
        top: 1.5rem;
        right: 2rem;
        color: var(--text-muted);
        text-decoration: none;
        font-size: 0.78rem;
        display: flex;
        align-items: center;
        gap: 0.4rem;
        transition: color 0.2s;
        border: 1px solid var(--border-subtle);
        padding: 0.35rem 0.75rem;
        border-radius: 4px;
    }

    .back-btn:hover { color: var(--text-accent); border-color: var(--border-medium); }
</style>
@endpush

@section('content')
<main class="gallery-main" style="width: 100%;">
    <div class="profile-header">
        <a href="{{ route('photographers.index') }}" class="back-btn">
            ← Volver a Autores
        </a>

        <div class="profile-avatar-wrap">
            <div class="photo-corner photo-corner--tl"></div>
            <div class="photo-corner photo-corner--br"></div>
            @if($photographer->portrait_url)
                <img src="{{ $photographer->portrait_url }}"
                     alt="{{ $photographer->full_name }}"
                     class="profile-avatar">
            @else
                <div class="profile-avatar" style="background: var(--bg-sidebar); display:flex; align-items:center; justify-content:center; color: var(--border-strong);">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                </div>
            @endif
        </div>

        <div class="profile-info">
            <h1 class="profile-name">{{ $photographer->full_name }}</h1>

            <div class="profile-meta">
                @if($photographer->birth_date || $photographer->death_date)
                <span>
                    {{ $photographer->birth_date?->year ?? '?' }}
                    &ndash;
                    {{ $photographer->death_date?->year ?? 'presente' }}
                </span>
                @endif

                @if($photographer->birth_place)
                <span class="profile-meta-sep">|</span>
                <span>{{ $photographer->birth_place }}</span>
                @endif
            </div>

            {{-- bloque de datos biográficos --}}
            @if($photographer->birth_date || $photographer->death_date || $photographer->birth_place || $photographer->death_place)
            <div class="profile-dates-block">
                @if($photographer->birth_date)
                <div class="profile-dates-item">
                    <span class="profile-dates-label">Fecha de nacimiento</span>
                    <span class="profile-dates-value">{{ $photographer->birth_date->format('d/m/Y') }}</span>
                </div>
                @endif
                @if($photographer->birth_place)
                <div class="profile-dates-item">
                    <span class="profile-dates-label">Lugar de nacimiento</span>
                    <span class="profile-dates-value">{{ $photographer->birth_place }}</span>
                </div>
                @endif
                @if($photographer->death_date)
                <div class="profile-dates-item">
                    <span class="profile-dates-label">Fecha de fallecimiento</span>
                    <span class="profile-dates-value">{{ $photographer->death_date->format('d/m/Y') }}</span>
                </div>
                @endif
                @if($photographer->death_place)
                <div class="profile-dates-item">
                    <span class="profile-dates-label">Lugar de fallecimiento</span>
                    <span class="profile-dates-value">{{ $photographer->death_place }}</span>
                </div>
                @endif
            </div>
            @endif

            <p class="profile-bio">{{ $photographer->bio ?? 'Biografía no disponible.' }}</p>

            @if($photographer->studies_critique)
            <div class="profile-critique">
                <div class="profile-critique-label">Crítica y Estudios</div>
                {{ $photographer->studies_critique }}
            </div>
            @endif

            <div class="profile-stats">
                <div class="stat-item">
                    <span class="stat-value">{{ $photos->total() }}</span>
                    <span class="stat-label">Fotografías</span>
                </div>
                @if($photographer->birth_date && $photographer->death_date)
                <div class="stat-item">
                    <span class="stat-value">{{ $photographer->death_date->year - $photographer->birth_date->year }}</span>
                    <span class="stat-label">Años de vida</span>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- barra de contexto de la galeria --}}
    @if($photos->count() > 0)
    <div class="gallery-context-bar">
        <div class="gallery-context-line"></div>
        <h2 class="gallery-context-title">Archivo de {{ \Illuminate\Support\Str::words($photographer->full_name, 2, '') }}</h2>
        <span class="gallery-context-count">{{ $photos->total() }} fotografía(s) catalogada(s)</span>
        <div class="gallery-context-line"></div>
    </div>

    <div class="photo-grid" id="photo-grid">
        @foreach($photos as $photo)
        <article class="photo-card" style="animation-delay: {{ $loop->index * 0.05 }}s">
            <div class="photo-card-inner">
                <div class="photo-card-img-wrap">
                    <div class="photo-corner photo-corner--tl"></div>
                    <div class="photo-corner photo-corner--br"></div>

                    @if($photo->image_url)
                        <img src="{{ $photo->image_url }}" alt="{{ $photo->title }}" class="photo-card-img" loading="lazy">
                    @elseif($photo->image_path)
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($photo->image_path) }}" alt="{{ $photo->title }}" class="photo-card-img" loading="lazy">
                    @else
                        <div class="photo-card-img" style="display:flex;align-items:center;justify-content:center;color:#555;">[Sin Imagen]</div>
                    @endif

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
                </div>
                <div class="photo-card-info">
                    <h3 class="photo-card-title">{{ $photo->title }}</h3>
                    <div class="photo-card-meta">
                        <div class="meta-categories">
                            @foreach($photo->categories->take(3) as $category)
                            <span class="cat-badge">{{ $category->name }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </article>
        @endforeach
    </div>

    @if($photos->hasPages())
    <div class="pagination-wrap">
        {{ $photos->links() }}
    </div>
    @endif

    @else
    <div class="empty-state">
        <div class="empty-icon">
            <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
        </div>
        <h2 class="empty-title">Archivo Vacío</h2>
        <p class="empty-desc">No se encontraron fotografías digitalizadas para este fotógrafo.</p>
        <a href="{{ route('photographers.index') }}" class="empty-btn">← Volver a Autores</a>
    </div>
    @endif
</main>
@endsection
