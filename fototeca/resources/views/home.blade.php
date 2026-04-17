@extends('layouts.home')

@section('content')

{{-- ══════════════════════════════════════════════════════════════
     HERO
═══════════════════════════════════════════════════════════════════ --}}
<section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-overlay"></div>
    <div class="hero-scanlines"></div>

    <div class="hero-body">
        <p class="hero-eyebrow">Ancash, Perú &nbsp;·&nbsp; Desde {{ $stats['since'] }}</p>

        <h1 class="hero-title">
            Fototeca
            <em class="hero-title-italic">Digital</em>
        </h1>

        <div class="divider-oro">
            <span>✦</span>
        </div>

        <p class="hero-subtitle">Archivo Histórico Visual del Callejón de Huaylas</p>

        <p class="hero-desc">
            Una colección de <strong style="color:var(--text-claro);">{{ $stats['photos'] }} fotografías</strong>
            que preservan la memoria visual de Ancash: desde el esplendor del Huaraz colonial
            hasta la resiliencia de su reconstrucción tras el terremoto de 1970.
        </p>

        <div class="hero-actions">
            <a href="{{ route('galeria') }}" class="btn-primary">Explorar Galería</a>
            <a href="#fotografos" class="btn-ghost">Los Fotógrafos</a>
        </div>
    </div>

    {{-- Film strip --}}
    <div class="filmstrip">
        <div class="filmstrip-holes"></div>
        @foreach($featuredPhotos as $photo)
            <div class="filmstrip-frame">
                <img src="{{ $photo->image_src }}" alt="{{ $photo->title }}" loading="eager">
            </div>
        @endforeach
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════════
     ESTADÍSTICAS
═══════════════════════════════════════════════════════════════════ --}}
<section class="section-dark" x-data="{
    counts: { photos: 0, photographers: 0, locations: 0, since: 0 },
    init() {
        const targets = {
            photos:        {{ $stats['photos'] }},
            photographers: {{ $stats['photographers'] }},
            locations:     {{ $stats['locations'] }},
            since:         {{ $stats['since'] }}
        };
        setTimeout(() => {
            Object.entries(targets).forEach(([key, target]) => {
                let start = key === 'since' ? target - 10 : 0;
                let current = start;
                let steps = 45;
                let step = Math.max(1, Math.ceil((target - start) / steps));
                let id = setInterval(() => {
                    current = Math.min(current + step, target);
                    this.counts[key] = current;
                    if (current >= target) clearInterval(id);
                }, 20);
            });
        }, 200);
    }
}">
    <div class="stats-grid">
        <div class="stat-item">
            <span class="stat-number" x-text="counts.photos">0</span>
            <span class="stat-label">Fotografías</span>
        </div>
        <div class="stat-item">
            <span class="stat-number" x-text="counts.photographers">0</span>
            <span class="stat-label">Fotógrafos</span>
        </div>
        <div class="stat-item">
            <span class="stat-number" x-text="counts.locations">0</span>
            <span class="stat-label">Localidades</span>
        </div>
        <div class="stat-item">
            <span class="stat-number" x-text="counts.since">0</span>
            <span class="stat-label">Desde el año</span>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════════
     ÉPOCAS HISTÓRICAS
═══════════════════════════════════════════════════════════════════ --}}
<section class="section-cream">
    <div class="section-inner">
        <div>
            <span class="section-tag">Colección</span>
            <h2 class="section-title">Una Historia en Cuatro Capítulos</h2>
            <p class="section-subtitle">
                Ancash a través del tiempo: desde el esplendor colonial de sus calles empedradas
                hasta la era contemporánea de sus montañas eternas.
            </p>
        </div>

        <div class="epochs-grid">
            {{-- Pre-terremoto --}}
            <a href="{{ route('galeria') }}?period=pre_terremoto" class="epoch-card">
                <div class="epoch-image"
                     style="background-image: url('https://picsum.photos/seed/catedral1955/800/600')"></div>
                <div class="epoch-overlay"></div>
                <div class="epoch-info">
                    <span class="epoch-years">Hasta 1970</span>
                    <h3>El Huaraz Colonial</h3>
                    <p class="epoch-count">{{ $periodCounts['pre_terremoto'] }} fotografías</p>
                    <span class="epoch-link">Ver colección →</span>
                </div>
            </a>

            {{-- Terremoto 1970 --}}
            <a href="{{ route('galeria') }}?period=terremoto_1970" class="epoch-card">
                <div class="epoch-image"
                     style="background-image: url('https://picsum.photos/seed/terremoto1970a/800/600')"></div>
                <div class="epoch-overlay"></div>
                <div class="epoch-info">
                    <span class="epoch-years">31 de mayo, 1970</span>
                    <h3>El Terremoto</h3>
                    <p class="epoch-count">{{ $periodCounts['terremoto_1970'] }} fotografías</p>
                    <span class="epoch-link">Ver colección →</span>
                </div>
            </a>

            {{-- Reconstrucción --}}
            <a href="{{ route('galeria') }}?period=reconstruccion" class="epoch-card">
                <div class="epoch-image"
                     style="background-image: url('https://picsum.photos/seed/reconstplaza1974/800/600')"></div>
                <div class="epoch-overlay"></div>
                <div class="epoch-info">
                    <span class="epoch-years">1970 — 1990</span>
                    <h3>La Reconstrucción</h3>
                    <p class="epoch-count">{{ $periodCounts['reconstruccion'] }} fotografías</p>
                    <span class="epoch-link">Ver colección →</span>
                </div>
            </a>

            {{-- Siglo XXI --}}
            <a href="{{ route('galeria') }}?period=siglo_xxi" class="epoch-card">
                <div class="epoch-image"
                     style="background-image: url('https://picsum.photos/seed/huascaran2008/800/600')"></div>
                <div class="epoch-overlay"></div>
                <div class="epoch-info">
                    <span class="epoch-years">2000 — Presente</span>
                    <h3>Siglo XXI</h3>
                    <p class="epoch-count">{{ $periodCounts['siglo_xxi'] }} fotografías</p>
                    <span class="epoch-link">Ver colección →</span>
                </div>
            </a>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════════
     FOTOGRAFÍAS DESTACADAS
═══════════════════════════════════════════════════════════════════ --}}
<section class="section-ink">
    <div class="section-inner" style="padding-bottom:3rem;">
        <span class="section-tag">Galería</span>
        <h2 class="section-title" style="color:var(--text-claro);">De la Colección</h2>
    </div>

    <div style="max-width:1200px;margin:0 auto;padding:0 2rem;">
        <div class="photos-grid">
            @foreach($featuredPhotos as $photo)
                <div class="photo-item">
                    <img src="{{ $photo->image_src }}" alt="{{ $photo->title }}" loading="lazy">
                    <div class="photo-item-caption">
                        <h4>{{ $photo->title }}</h4>
                        <p>
                            {{ $photo->year_label }}
                            @if($photo->photographers->isNotEmpty())
                                &nbsp;·&nbsp; {{ $photo->photographers->first()->display_name }}
                            @endif
                            @if($photo->location)
                                &nbsp;·&nbsp; {{ $photo->location->name }}
                            @endif
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="section-cta" style="padding-bottom:5rem;">
        <a href="{{ route('galeria') }}" class="btn-primary">Ver Colección Completa</a>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════════
     FOTÓGRAFOS
═══════════════════════════════════════════════════════════════════ --}}
<section class="section-cream" id="fotografos">
    <div class="section-inner">
        <span class="section-tag">Autores</span>
        <h2 class="section-title">Los Fotógrafos</h2>
        <p class="section-subtitle">
            Las miradas que preservaron la historia visual de Ancash.
            Cada imagen es el testigo silencioso de una época.
        </p>

        <div class="photographers-grid">
            @foreach($photographers as $photographer)
                <div class="photographer-card">
                    <div class="photographer-avatar">
                        {{ $photographer->initial }}
                    </div>
                    <div class="photographer-info">
                        <p class="photographer-name">{{ $photographer->display_name }}</p>
                        <div class="photographer-meta">
                            @if($photographer->lifespan)
                                <span>{{ $photographer->lifespan }}</span>
                            @endif
                            @if($photographer->nationality)
                                <span>{{ $photographer->nationality }}</span>
                            @endif
                        </div>
                        @if($photographer->biography)
                            <p class="photographer-bio">
                                {{ \Illuminate\Support\Str::limit($photographer->biography, 140) }}
                            </p>
                        @endif
                        <p class="photographer-count">
                            {{ $photographer->photos_count }}
                            {{ $photographer->photos_count === 1 ? 'fotografía' : 'fotografías' }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════════
     MISIÓN
═══════════════════════════════════════════════════════════════════ --}}
<section class="section-dark">
    <div class="mission-inner">
        <div class="mission-quote">
            <span class="quote-mark">"</span>
            <p>
                Preservar la imagen es preservar la memoria.
                Cada fotografía es un testigo silencioso que habla
                más alto que cualquier crónica escrita.
            </p>
            <cite>— Archivo Fotográfico de Ancash</cite>
        </div>

        <div class="mission-text">
            <span class="section-tag">Nuestra misión</span>
            <h2 class="section-title" style="color:var(--text-claro);margin-top:.5rem;">
                Preservar la memoria<br>visual de Ancash
            </h2>
            <p>
                La Fototeca Digital de Ancash recopila, digitaliza y cataloga fotografías históricas
                que documentan la vida, la arquitectura, los paisajes y los eventos de la región
                desde finales del siglo XIX hasta nuestros días.
            </p>
            <p>
                El terremoto del 31 de mayo de 1970 devastó el Callejón de Huaylas, sepultando
                para siempre el Huaraz colonial y la ciudad de Yungay. Esta colección honra
                esa memoria y documenta el extraordinario proceso de reconstrucción que siguió
                a la tragedia.
            </p>
            <div style="margin-top:2rem;">
                <a href="{{ route('galeria') }}" class="btn-primary">Explorar el Archivo</a>
            </div>
        </div>
    </div>
</section>

@endsection
