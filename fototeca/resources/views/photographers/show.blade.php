@extends('layouts.gallery')

@section('title', $photographer->name . ' - Fototeca Digital Ancashina')

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
        .profile-header {
            flex-direction: column;
            padding: 2rem;
            gap: 1.5rem;
        }
        .profile-avatar-wrap { width: 160px; height: 160px; }
        .profile-name { font-size: 1.8rem; }
        .back-btn { position: static; margin-bottom: 0.5rem; align-self: flex-start; }
        .profile-stats { flex-wrap: wrap; gap: 1rem; }
    }
    @media (max-width: 480px) {
        .profile-header { padding: 1.25rem; }
        .profile-avatar-wrap { width: 120px; height: 120px; }
        .profile-name { font-size: 1.5rem; }
        .profile-bio { font-size: 0.88rem; }
    }

    .profile-avatar-wrap {
        width: 200px;
        height: 200px;
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
    
    .profile-info {
        flex: 1;
    }
    
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
        font-size: 1rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .profile-bio {
        font-size: 0.95rem;
        line-height: 1.8;
        color: var(--text-secondary);
        max-width: 800px;
        margin-bottom: 1.5rem;
    }
    
    .profile-stats {
        display: flex;
        gap: 1.5rem;
        border-top: 1px dashed var(--border-medium);
        padding-top: 1.5rem;
        max-width: 800px;
    }
    
    .stat-item {
        display: flex;
        flex-direction: column;
        color: var(--text-muted);
    }
    
    .stat-value {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--sepia-light);
        font-family: 'Playfair Display', serif;
    }
    
    .stat-label {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .back-btn {
        position: absolute;
        top: 1.5rem;
        right: 2rem;
        color: var(--text-muted);
        text-decoration: none;
        font-size: 0.8rem;
        display: flex;
        align-items: center;
        gap: 0.4rem;
        transition: color 0.2s;
    }
    
    .back-btn:hover {
        color: var(--text-accent);
    }
</style>
@endpush

@section('content')
<main class="gallery-main" style="width: 100%;">
    <div class="profile-header">
        <a href="{{ route('photographers.index') }}" class="back-btn">
            <span>←</span> Volver a Autores
        </a>
        
        <div class="profile-avatar-wrap">
            <div class="photo-corner photo-corner--tl"></div>
            <div class="photo-corner photo-corner--br"></div>
            @if($photographer->portrait_path)
                <img src="{{ $photographer->portrait_path }}" alt="{{ $photographer->name }}" class="profile-avatar">
            @else
                <div class="profile-avatar" style="background: var(--bg-sidebar); display: flex; align-items: center; justify-content: center; font-size: 4rem; color: var(--border-strong);">
                    @if($photographer->is_anonymous)
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M6 20v-2a6 6 0 0 1 12 0v2"/><path d="M3 11h2M19 11h2M12 3V1"/></svg>
                    @else
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                    @endif
                </div>
            @endif
        </div>
        
        <div class="profile-info">
            <h1 class="profile-name">{{ $photographer->name }}</h1>
            <div class="profile-meta">
                @if(!$photographer->is_anonymous)
                    <span>{{ $photographer->birth_year ?? '?' }} — {{ $photographer->death_year ?? '?' }}</span>
                    @if($photographer->nationality)
                        <span style="opacity: 0.5;">|</span>
                        <span>{{ $photographer->nationality }}</span>
                    @endif
                @else
                    <span>Colección de múltiples orígenes</span>
                @endif
            </div>
            
            <p class="profile-bio">{{ $photographer->biography ?? 'Biografía no disponible.' }}</p>
            
            <div class="profile-stats">
                <div class="stat-item">
                    <span class="stat-value">{{ $photos->total() }}</span>
                    <span class="stat-label">Fotografías</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Barra de contexto -->
    <div class="gallery-context-bar">
        <h2 class="gallery-context-title">Archivo de {{ $photographer->is_anonymous ? 'Autores Anónimos' : Str::words($photographer->name, 2, '') }}</h2>
        <div class="gallery-context-line"></div>
        <span class="gallery-context-count">Mostrando {{ $photos->firstItem() ?? 0 }}-{{ $photos->lastItem() ?? 0 }} de {{ $photos->total() }}</span>
    </div>

    @if($photos->count() > 0)
        <div class="photo-grid">
            @foreach($photos as $photo)
                <a href="/admin/photos/{{ $photo->id }}/edit" class="photo-card" style="text-decoration:none;">
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
                                    <div class="overlay-year">{{ $photo->circa ? 'c. ' : '' }}{{ $photo->year }}</div>
                                    @if($photo->location)
                                        <div class="overlay-location"><svg width="11" height="11" viewBox="0 0 24 24" fill="currentColor" style="flex-shrink:0;"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg> {{ $photo->location->name }}</div>
                                    @endif
                                    <div class="overlay-period-tag">{{ $photo->historical_period->label() }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="photo-card-info">
                            <h3 class="photo-card-title">{{ $photo->title }}</h3>
                            <div class="photo-card-meta">
                                <div class="meta-categories">
                                    @foreach($photo->categories as $category)
                                        <span class="cat-badge">{{ $category->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        @if($photos->hasPages())
            <div class="pagination-wrap">
                {{ $photos->links() }}
            </div>
        @endif
    @else
        <div class="empty-state">
            <div class="empty-icon">📁</div>
            <h2 class="empty-title">Archivo Vacío</h2>
            <p class="empty-desc">No se encontraron fotografías digitalizadas para este fotógrafo.</p>
        </div>
    @endif
</main>
@endsection
