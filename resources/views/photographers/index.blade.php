@extends('layouts.gallery')

@section('title', 'Fotógrafos · Fototeca Digital Ancashina')

@push('scripts')
<style>
    .photographer-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
        padding: 2rem;
        max-width: 1400px;
        margin: 0 auto;
    }
    @media (max-width: 600px) {
        .photographer-grid { grid-template-columns: 1fr; gap: 1.25rem; padding: 1.25rem; }
        .page-header { padding: 2rem 1.25rem 1rem; }
        .page-title { font-size: 1.8rem; }
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
        aspect-ratio: 3 / 2;
        overflow: hidden;
        background: #111;
        border-bottom: 2px solid var(--wood-dark);
    }

    .card-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: sepia(0.35) contrast(1.1) brightness(0.85);
        transition: filter 0.5s ease, transform 0.5s ease;
    }

    .photographer-card:hover .card-img {
        filter: sepia(0.1) contrast(1) brightness(1);
        transform: scale(1.05);
    }

    .card-img-placeholder {
        width: 100%;
        height: 100%;
        background: var(--bg-sidebar);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--border-strong);
        font-size: 3.5rem;
    }

    .card-century-badge {
        position: absolute;
        top: 0.75rem;
        right: 0.75rem;
        background: rgba(0,0,0,0.75);
        border: 1px solid var(--border-medium);
        color: var(--text-accent);
        font-size: 0.65rem;
        padding: 0.2rem 0.5rem;
        border-radius: 20px;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        font-weight: 600;
        backdrop-filter: blur(4px);
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
        font-size: 1.2rem;
        color: var(--sepia-light);
        margin-bottom: 0.35rem;
        font-weight: 700;
        line-height: 1.25;
    }

    .card-dates {
        font-family: 'Libre Baskerville', serif;
        font-style: italic;
        font-size: 0.8rem;
        color: var(--text-accent);
        margin-bottom: 0.35rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .card-birthplace {
        font-size: 0.75rem;
        color: var(--text-muted);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .card-bio {
        font-size: 0.83rem;
        color: var(--text-secondary);
        line-height: 1.65;
        margin-bottom: 1.25rem;
        display: -webkit-box;
        -webkit-line-clamp: 4;
        -webkit-box-orient: vertical;
        overflow: hidden;
        flex: 1;
    }

    .card-footer {
        margin-top: auto;
        padding-top: 0.9rem;
        border-top: 1px dashed var(--border-medium);
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.73rem;
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
        font-size: 0.95rem;
        line-height: 1.8;
        max-width: 600px;
        margin: 0 auto;
    }

    /* separador de seccion anonimos */
    .section-divider {
        text-align: center;
        padding: 2rem 2rem 0.5rem;
        font-family: 'Playfair Display', serif;
        font-size: 1.1rem;
        color: var(--text-muted);
        letter-spacing: 0.1em;
        display: flex;
        align-items: center;
        gap: 1rem;
        max-width: 1400px;
        margin: 0 auto;
    }
    .section-divider::before,
    .section-divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--border-subtle);
    }
</style>
@endpush

@section('content')
<main class="gallery-main" style="width: 100%;">
    <div class="page-header">
        <h1 class="page-title">Autores de la Memoria Visual</h1>
        <p class="page-desc">
            Conoce a los fotógrafos cuya mirada nos ha legado el patrimonio histórico de la región
            Ancash. Cada uno, con su propio estilo y época, aportó una pieza fundamental al
            rompecabezas de nuestra historia colectiva.
        </p>
    </div>

    <div class="photographer-grid">
        @foreach($photographers as $photographer)
        @php
            // evitar mostrar el anonimo en el grid principal
            if (str_contains(strtolower($photographer->full_name), 'desconocido') ||
                str_contains(strtolower($photographer->full_name), 'autor')
            ) continue;
            // calcular siglo de actividad
            $year = $photographer->birth_date?->year;
            $century = $year ? (int) ceil($year / 100) : null;
            $centuryLabel = $century ? 'Siglo ' . (match($century) { 19 => 'XIX', 20 => 'XX', 21 => 'XXI', default => $century . 'º' }) : null;
        @endphp
        <a href="{{ route('photographers.show', $photographer->id) }}" class="photographer-card" style="animation-delay: {{ $loop->index * 0.08 }}s">
            <div class="card-img-wrap">
                <div class="photo-corner photo-corner--tl"></div>
                <div class="photo-corner photo-corner--br"></div>

                @if($photographer->portrait_url)
                    <img src="{{ $photographer->portrait_url }}"
                         alt="{{ $photographer->full_name }}"
                         class="card-img">
                @else
                    <div class="card-img-placeholder">
                        <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                    </div>
                @endif

                @if($centuryLabel)
                <span class="card-century-badge">{{ $centuryLabel }}</span>
                @endif
            </div>

            <div class="card-info">
                <h2 class="card-title">{{ $photographer->full_name }}</h2>

                <div class="card-dates">
                    @if($photographer->birth_date || $photographer->death_date)
                        <span>
                            {{ $photographer->birth_date?->year ?? '?' }}
                            —
                            {{ $photographer->death_date?->year ?? 'presente' }}
                        </span>
                    @endif
                </div>

                @if($photographer->birth_place)
                <div class="card-birthplace">
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                    {{ $photographer->birth_place }}
                </div>
                @endif

                <p class="card-bio">{{ $photographer->bio ?? 'Biografía no disponible.' }}</p>

                <div class="card-footer">
                    <span>Ver colección</span>
                    <span class="count-badge">{{ $photographer->photos_count }} fotos</span>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    {{-- seccion especial: autores anonimos --}}
    @if($anonymous)
    <div class="section-divider">Archivos Anónimos</div>
    <div class="photographer-grid" style="padding-top: 1rem;">
        <a href="{{ route('photographers.show', $anonymous->id) }}" class="photographer-card">
            <div class="card-img-wrap" style="border-bottom-color: var(--border-medium);">
                <div class="photo-corner photo-corner--tl"></div>
                <div class="photo-corner photo-corner--br"></div>
                <div class="card-img-placeholder" style="background: linear-gradient(135deg, var(--bg-sidebar), var(--bg-main));">
                    <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2"><circle cx="12" cy="8" r="4"/><path d="M6 20v-2a6 6 0 0 1 12 0v2"/><path d="M3 11h2M19 11h2M12 3V1"/></svg>
                </div>
            </div>
            <div class="card-info">
                <h2 class="card-title" style="color: var(--text-muted);">{{ $anonymous->full_name }}</h2>
                <div class="card-dates">Múltiples épocas · Archivo colectivo</div>
                <p class="card-bio">{{ $anonymous->bio }}</p>
                <div class="card-footer">
                    <span>Explorar archivo anónimo</span>
                    <span class="count-badge">{{ $anonymous->photos()->count() }} fotos</span>
                </div>
            </div>
        </a>
    </div>
    @endif
</main>
@endsection
