<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Fototeca Digital Ancashina – Archivo histórico fotográfico de la región Ancash, Perú.">
    <title>@yield('title', 'Fototeca Digital Ancashina')</title>

    {{-- alpine.js para acordeones --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    {{-- fuentes de google --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&family=Libre+Baskerville:ital@0;1&display=swap" rel="stylesheet">

    <style>
        /* ─── VARIABLES TEMA BIBLIOTECA ─────────────────────────────── */
        :root {
            --bg-page:         #1a1410;     /* fondo general oscuro madera quemada */
            --bg-sidebar:      #120f0c;     /* sidebar muy oscuro */
            --bg-main:         #1e1810;     /* area principal */
            --bg-card:         #2a2318;     /* fondo de las tarjetas */
            --bg-card-hover:   #342b1d;
            --bg-topbar:       #16120d;     /* barra superior */

            --wood-light:      #c9956a;     /* madera clara / acento */
            --wood-mid:        #a0724a;     /* madera media */
            --wood-dark:       #7a5236;     /* madera oscura */
            --sepia-light:     #f0e4d0;     /* papel envejecido claro */
            --sepia-mid:       #d4b896;     /* papel envejecido medio */
            --sepia-dark:      #8a7060;     /* sepia oscuro */

            --text-primary:    #f0e4d0;     /* texto principal en sepia claro */
            --text-secondary:  #a89880;     /* texto secundario */
            --text-muted:      #6a5c50;     /* texto apagado */
            --text-accent:     #c9956a;     /* texto de acento / madera */

            --accent-gold:     #d4a843;     /* oro para destacados */
            --accent-rust:     #b5451b;     /* terracota / periodo terremoto */

            --border-subtle:   rgba(201,149,106,0.12);
            --border-medium:   rgba(201,149,106,0.25);
            --border-strong:   rgba(201,149,106,0.45);

            --sidebar-w:       300px;
            --topbar-h:        64px;
            --radius-card:     3px;
        }

        [x-cloak] { display: none !important; }

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html { scroll-behavior: smooth; }

        body {
            background: var(--bg-page);
            color: var(--text-primary);
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            /* textura sutil de papel/madera usando gradiente radial */
            background-image:
                radial-gradient(ellipse at 0% 0%, rgba(201,149,106,0.06) 0%, transparent 50%),
                radial-gradient(ellipse at 100% 100%, rgba(122,82,54,0.08) 0%, transparent 50%);
        }

        /* ─── NAV GLOBAL ─────────────────────────────────────────────── */
        .global-nav {
            background: var(--bg-topbar);
            border-bottom: 1px solid var(--border-subtle);
            padding: 0 1.5rem;
            height: 52px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 200;
            backdrop-filter: blur(8px);
        }
        .global-nav-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-accent);
            letter-spacing: 0.08em;
            text-decoration: none;
        }
        .global-nav-brand span {
            color: var(--text-muted);
            font-weight: 400;
            font-size: 0.8rem;
            margin-left: 0.5rem;
        }
        .global-nav-links {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }
        .global-nav-links a {
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 500;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            transition: color 0.2s;
        }
        .global-nav-links a:hover,
        .global-nav-links a.active {
            color: var(--text-accent);
        }
        .global-nav-links a.active {
            border-bottom: 2px solid var(--wood-light);
            padding-bottom: 2px;
        }
        .nav-upload-btn {
            background: linear-gradient(135deg, var(--wood-mid), var(--wood-dark));
            color: var(--sepia-light) !important;
            padding: 0.35rem 0.9rem !important;
            border-radius: 3px;
            font-size: 0.75rem !important;
            border: 1px solid var(--wood-light);
            transition: all 0.2s !important;
        }
        .nav-upload-btn:hover {
            background: linear-gradient(135deg, var(--wood-light), var(--wood-mid)) !important;
            box-shadow: 0 0 12px rgba(201,149,106,0.3);
        }

        /* Global nav hamburger */
        .global-nav-hamburger {
            display: none;
            flex-direction: column;
            gap: 4px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 6px;
            border-radius: 4px;
            transition: background 0.2s;
        }
        .global-nav-hamburger:hover { background: var(--border-subtle); }
        .global-nav-hamburger span {
            display: block;
            width: 20px;
            height: 2px;
            background: var(--text-secondary);
            border-radius: 1px;
            transition: transform 0.3s, opacity 0.3s;
        }
        .global-nav-hamburger.open span:nth-child(1) { transform: translateY(6px) rotate(45deg); }
        .global-nav-hamburger.open span:nth-child(2) { opacity: 0; }
        .global-nav-hamburger.open span:nth-child(3) { transform: translateY(-6px) rotate(-45deg); }

        /* Global nav mobile dropdown */
        .global-nav-mobile {
            display: none;
            position: absolute;
            top: 100%;
            left: 0; right: 0;
            background: var(--bg-topbar);
            border-bottom: 1px solid var(--border-subtle);
            flex-direction: column;
            padding: 0.5rem 1.5rem 1rem;
            gap: 0.25rem;
            z-index: 199;
            box-shadow: 0 8px 24px rgba(0,0,0,0.4);
        }
        .global-nav-mobile.open { display: flex; }
        .global-nav-mobile a {
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 0.7rem 0;
            border-bottom: 1px solid var(--border-subtle);
            transition: color 0.2s;
        }
        .global-nav-mobile a:last-child { border-bottom: none; }
        .global-nav-mobile a:hover,
        .global-nav-mobile a.active { color: var(--text-accent); }

        /* ─── LAYOUT PRINCIPAL ───────────────────────────────────────── */
        .gallery-layout {
            display: flex;
            flex: 1;
            min-height: calc(100vh - 52px);
        }

        /* ─── SIDEBAR ─────────────────────────────────────────────────── */
        .sidebar {
            width: var(--sidebar-w);
            min-width: var(--sidebar-w);
            background: var(--bg-sidebar);
            border-right: 1px solid var(--border-subtle);
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            overflow-x: hidden;
            position: sticky;
            top: 52px;
            height: calc(100vh - 52px);
            scrollbar-width: thin;
            scrollbar-color: var(--wood-dark) transparent;
            /* patron de madera simulado con gradiente lineal --*/
            background-image:
                repeating-linear-gradient(
                    90deg,
                    transparent,
                    transparent 80px,
                    rgba(201,149,106,0.015) 80px,
                    rgba(201,149,106,0.015) 81px
                );
        }
        .sidebar::-webkit-scrollbar { width: 4px; }
        .sidebar::-webkit-scrollbar-track { background: transparent; }
        .sidebar::-webkit-scrollbar-thumb { background: var(--wood-dark); border-radius: 2px; }

        /* cabecera del sidebar */
        .sidebar-header {
            padding: 1.25rem 1rem;
            border-bottom: 1px solid var(--border-subtle);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: rgba(0,0,0,0.2);
        }
        .sidebar-logo {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--wood-dark), var(--wood-mid));
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--sepia-light);
            flex-shrink: 0;
        }
        .sidebar-title-text {
            font-family: 'Playfair Display', serif;
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text-accent);
            letter-spacing: 0.1em;
        }
        .sidebar-subtitle-text {
            font-size: 0.7rem;
            color: var(--text-muted);
            letter-spacing: 0.04em;
        }
        .sidebar-close-btn {
            display: none;
            margin-left: auto;
            background: none;
            border: none;
            color: var(--text-muted);
            font-size: 1rem;
            cursor: pointer;
            width: 28px;
            height: 28px;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            transition: color 0.2s, background 0.2s;
        }
        @media (max-width: 768px) {
            .sidebar-close-btn { display: flex; }
        }
        .sidebar-close-btn:hover { color: var(--text-accent); background: var(--border-subtle); }

        /* buscador del sidebar */
        .sidebar-search-form { padding: 0.75rem 1rem; border-bottom: 1px solid var(--border-subtle); }
        .sidebar-search-wrap {
            position: relative;
        }
        .sidebar-search-icon {
            position: absolute;
            left: 0.6rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
        }
        .sidebar-search-input {
            width: 100%;
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--border-medium);
            border-radius: 4px;
            padding: 0.45rem 0.75rem 0.45rem 2rem;
            color: var(--text-primary);
            font-size: 0.8rem;
            font-family: 'Inter', sans-serif;
            transition: border-color 0.2s, background 0.2s;
            outline: none;
        }
        .sidebar-search-input::placeholder { color: var(--text-muted); }
        .sidebar-search-input:focus {
            border-color: var(--wood-mid);
            background: rgba(201,149,106,0.05);
        }

        /* secciones del sidebar */
        .sidebar-section { padding: 1rem 0.5rem 0; }
        .sidebar-section-label {
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--text-muted);
            padding: 0 0.5rem 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }
        .sidebar-section-icon { font-size: 0.9rem; }

        /* acordeones del sidebar */
        .accordion-group { margin-bottom: 2px; }
        .accordion-group.sub { margin-left: 0.5rem; border-left: 1px solid var(--border-subtle); }
        .accordion-btn {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.55rem 0.6rem;
            background: none;
            border: none;
            color: var(--text-secondary);
            font-size: 0.82rem;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            border-radius: 4px;
            text-align: left;
            transition: background 0.15s, color 0.15s;
            text-decoration: none;
        }
        .accordion-btn:hover { background: var(--border-subtle); color: var(--text-primary); }
        .accordion-btn--open { color: var(--text-accent) !important; background: rgba(201,149,106,0.08) !important; }
        .accordion-btn--sub { font-size: 0.78rem; padding: 0.45rem 0.6rem; }
        .accordion-btn-text { flex: 1; }
        .accordion-icon { font-size: 0.9rem; flex-shrink: 0; }
        .accordion-chevron { flex-shrink: 0; transition: transform 0.25s ease; color: var(--text-muted); }
        .accordion-chevron.rotated { transform: rotate(180deg); }

        .accordion-panel {
            overflow: hidden;
            padding-left: 0.25rem;
        }

        /* hojas del arbol (items clickeables finales) */
        .sidebar-leaf {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.4rem 0.6rem 0.4rem 1.4rem;
            color: var(--text-muted);
            font-size: 0.78rem;
            text-decoration: none;
            border-radius: 3px;
            transition: background 0.15s, color 0.15s;
        }
        .sidebar-leaf:hover { background: var(--border-subtle); color: var(--text-secondary); }
        .sidebar-leaf--active {
            color: var(--text-accent) !important;
            background: rgba(201,149,106,0.12) !important;
            font-weight: 600;
        }
        .leaf-dot {
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: var(--wood-dark);
            flex-shrink: 0;
        }
        .sidebar-leaf--active .leaf-dot { background: var(--wood-light); }

        /* footer del sidebar */
        .sidebar-footer {
            margin-top: auto;
            padding: 1rem;
            border-top: 1px solid var(--border-subtle);
            font-size: 0.7rem;
            color: var(--text-muted);
            line-height: 1.8;
        }

        /* ─── TOPBAR DE FILTROS ──────────────────────────────────────── */
        .gallery-main {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
            background: var(--bg-main);
        }

        .topbar {
            background: var(--bg-topbar);
            border-bottom: 1px solid var(--border-subtle);
            padding: 0 1.5rem;
            min-height: var(--topbar-h);
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
            position: sticky;
            top: 52px;
            z-index: 100;
        }
        .topbar-left {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .hamburger-btn {
            display: none;
            flex-direction: column;
            gap: 4px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 6px;
            border-radius: 4px;
            transition: background 0.2s;
        }
        @media (max-width: 768px) { .hamburger-btn { display: flex; } }
        .hamburger-btn:hover { background: var(--border-subtle); }
        .hamburger-btn span {
            display: block;
            width: 18px;
            height: 2px;
            background: var(--text-secondary);
            border-radius: 1px;
        }

        .topbar-breadcrumb { display: flex; align-items: center; gap: 0.4rem; font-size: 0.78rem; }
        .topbar-breadcrumb-home { color: var(--text-muted); }
        .topbar-breadcrumb-sep { color: var(--text-muted); }
        .topbar-breadcrumb-current { color: var(--text-accent); font-weight: 500; }

        .topbar-filters {
            display: flex;
            gap: 0.4rem;
            flex-wrap: wrap;
            margin-left: auto;
        }
        .filter-pill {
            padding: 0.3rem 0.75rem;
            border: 1px solid var(--border-medium);
            border-radius: 20px;
            color: var(--text-muted);
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.06em;
            text-decoration: none;
            transition: all 0.2s;
            white-space: nowrap;
        }
        .filter-pill:hover {
            border-color: var(--wood-mid);
            color: var(--text-primary);
            background: rgba(201,149,106,0.08);
        }
        .filter-pill--active {
            background: linear-gradient(135deg, var(--wood-dark), var(--wood-mid));
            border-color: var(--wood-light);
            color: var(--sepia-light);
        }

        .clear-filters-btn {
            padding: 0.3rem 0.7rem;
            background: rgba(181,69,27,0.15);
            border: 1px solid rgba(181,69,27,0.4);
            border-radius: 4px;
            color: #d4785a;
            font-size: 0.7rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
        }
        .clear-filters-btn:hover { background: rgba(181,69,27,0.3); color: #e89070; }

        /* ─── BARRA CONTEXTUAL DE GALERIA ────────────────────────────── */
        .gallery-context-bar {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border-subtle);
        }
        .gallery-context-line {
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--border-medium), transparent);
        }
        .gallery-context-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-accent);
            white-space: nowrap;
        }
        .gallery-context-count {
            font-size: 0.72rem;
            color: var(--text-muted);
            white-space: nowrap;
            font-style: italic;
        }

        /* ─── GRID DE FOTOGRAFIAS ─────────────────────────────────────── */
        .photo-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 1.25rem;
            padding: 1.5rem;
        }

        @media (max-width: 900px) {
            .photo-grid { grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 1rem; }
        }
        @media (max-width: 600px) {
            .photo-grid { grid-template-columns: repeat(2, 1fr); gap: 0.75rem; padding: 1rem; }
        }

        /* tarjeta de foto */
        .photo-card {
            animation: cardIn 0.4s ease both;
        }
        @keyframes cardIn {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .photo-card-inner {
            background: var(--bg-card);
            border: 1px solid var(--border-subtle);
            border-radius: var(--radius-card);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
            cursor: pointer;
            position: relative;
        }
        .photo-card-inner:hover {
            transform: translateY(-4px) scale(1.01);
            box-shadow:
                0 12px 32px rgba(0,0,0,0.5),
                0 0 0 1px var(--border-medium),
                0 0 20px rgba(201,149,106,0.08);
            border-color: var(--border-medium);
        }

        /* imagen de la tarjeta */
        .photo-card-img-wrap {
            position: relative;
            aspect-ratio: 4/3;
            overflow: hidden;
            background: #111;
        }
        .photo-card-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            /* efecto sepia sutil para simular archivo historico */
            filter: sepia(0.2) contrast(0.95) brightness(0.92);
            transition: filter 0.4s ease, transform 0.4s ease;
        }
        .photo-card-inner:hover .photo-card-img {
            filter: sepia(0) contrast(1) brightness(1);
            transform: scale(1.05);
        }

        /* overlay al hover */
        .photo-card-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(10,7,5,0.92) 0%, rgba(10,7,5,0.3) 60%, transparent 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            align-items: flex-end;
        }
        .photo-card-inner:hover .photo-card-overlay { opacity: 1; }
        .photo-card-overlay-content {
            padding: 1rem;
            width: 100%;
        }
        .overlay-year {
            font-family: 'Libre Baskerville', serif;
            font-style: italic;
            font-size: 1.1rem;
            color: var(--text-accent);
            margin-bottom: 0.25rem;
        }
        .overlay-location {
            font-size: 0.72rem;
            color: var(--sepia-mid);
            display: flex;
            align-items: center;
            gap: 0.3rem;
            margin-bottom: 0.4rem;
        }
        .overlay-period-tag {
            display: inline-block;
            background: rgba(201,149,106,0.2);
            border: 1px solid var(--border-medium);
            color: var(--text-accent);
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0.15rem 0.5rem;
            border-radius: 2px;
        }

        /* marcos de esquina tipo archivo fotografico */
        .photo-corner {
            position: absolute;
            width: 12px;
            height: 12px;
        }
        .photo-corner--tl {
            top: 6px; left: 6px;
            border-top: 1.5px solid var(--wood-mid);
            border-left: 1.5px solid var(--wood-mid);
        }
        .photo-corner--br {
            bottom: 6px; right: 6px;
            border-bottom: 1.5px solid var(--wood-mid);
            border-right: 1.5px solid var(--wood-mid);
        }

        /* info de la tarjeta */
        .photo-card-info {
            padding: 0.75rem 0.9rem;
            background: linear-gradient(180deg, var(--bg-card) 0%, rgba(20,15,10,0.95) 100%);
        }
        .photo-card-title {
            font-family: 'Playfair Display', serif;
            font-size: 0.88rem;
            font-weight: 600;
            color: var(--text-primary);
            line-height: 1.35;
            margin-bottom: 0.4rem;
            /* cortar texto largo */
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .photo-card-meta {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }
        .meta-photographer {
            font-size: 0.7rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }
        .meta-categories {
            display: flex;
            gap: 0.3rem;
            flex-wrap: wrap;
        }
        .cat-badge {
            font-size: 0.62rem;
            background: rgba(201,149,106,0.1);
            border: 1px solid var(--border-subtle);
            color: var(--sepia-dark);
            padding: 0.1rem 0.4rem;
            border-radius: 2px;
        }

        /* ─── PAGINACION ─────────────────────────────────────────────── */
        .pagination-wrap {
            padding: 1.5rem;
            display: flex;
            justify-content: center;
        }
        .pagination-wrap .pagination {
            display: flex;
            gap: 0.4rem;
            list-style: none;
        }
        .pagination-wrap .page-link {
            background: var(--bg-card);
            border: 1px solid var(--border-medium);
            color: var(--text-secondary);
            padding: 0.4rem 0.75rem;
            border-radius: 3px;
            text-decoration: none;
            font-size: 0.8rem;
            transition: all 0.2s;
        }
        .pagination-wrap .page-link:hover {
            background: var(--border-subtle);
            color: var(--text-accent);
        }
        .pagination-wrap .active .page-link {
            background: var(--wood-dark) !important;
            border-color: var(--wood-mid) !important;
            color: var(--sepia-light) !important;
        }
        .pagination-wrap .disabled .page-link { opacity: 0.4; pointer-events: none; }

        /* ─── ESTADO VACÍO ────────────────────────────────────────────── */
        .empty-state {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 5rem 2rem;
            text-align: center;
            gap: 1rem;
        }
        .empty-icon { color: var(--text-secondary); }
        .empty-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            color: var(--text-secondary);
        }
        .empty-desc { color: var(--text-muted); font-size: 0.9rem; max-width: 28rem; }
        .empty-btn {
            display: inline-block;
            margin-top: 0.5rem;
            background: linear-gradient(135deg, var(--wood-dark), var(--wood-mid));
            color: var(--sepia-light);
            padding: 0.6rem 1.5rem;
            border-radius: 3px;
            border: 1px solid var(--wood-light);
            font-size: 0.82rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
        }
        .empty-btn:hover {
            background: linear-gradient(135deg, var(--wood-mid), var(--wood-light));
            box-shadow: 0 0 16px rgba(201,149,106,0.3);
        }

        /* ─── OVERLAY PARA SIDEBAR MOVIL ─────────────────────────────── */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.6);
            z-index: 149;
            backdrop-filter: blur(2px);
        }
        @media (max-width: 768px) {
            .global-nav { position: relative; }
            .global-nav-links { display: none; }
            .global-nav-hamburger { display: flex; }

            .gallery-layout { position: relative; }
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                z-index: 150;
            }
            .sidebar--open { transform: translateX(0) !important; }
            .sidebar-overlay.overlay--visible { display: block; }

            .topbar { flex-wrap: nowrap; overflow: hidden; gap: 0.5rem; padding: 0 1rem; }
            .topbar-filters {
                margin-left: 0;
                overflow-x: auto;
                flex-wrap: nowrap;
                -webkit-overflow-scrolling: touch;
                scrollbar-width: none;
                padding-bottom: 2px;
            }
            .topbar-filters::-webkit-scrollbar { display: none; }
            .gallery-context-bar { padding: 1rem; }
            .photo-grid { padding: 1rem; }
        }
        @media (max-width: 480px) {
            .topbar { min-height: auto; padding: 0.6rem 0.75rem; }
            .topbar-breadcrumb { font-size: 0.72rem; }
            .photo-grid { grid-template-columns: repeat(2, 1fr); gap: 0.6rem; padding: 0.75rem; }
            .global-nav { padding: 0 1rem; height: 48px; }
            .global-nav-brand { font-size: 0.9rem; }
        }

        /* ─── SCROLLBAR GLOBAL FINA ───────────────────────────────────── */
        * {
            scrollbar-width: thin;
            scrollbar-color: var(--wood-dark) transparent;
        }
        *::-webkit-scrollbar { width: 5px; height: 5px; }
        *::-webkit-scrollbar-track { background: transparent; }
        *::-webkit-scrollbar-thumb { background: var(--wood-dark); border-radius: 3px; }
    </style>
</head>
<body>
    {{-- navegacion global superior --}}
    <nav class="global-nav" aria-label="Navegacion principal">
        <a href="{{ url('/') }}" class="global-nav-brand">
            FOTOTECA <span>Digital Ancashina</span>
        </a>
        <div class="global-nav-links">
            <a href="{{ url('/') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Inicio</a>
            <a href="{{ route('galeria') }}" class="{{ request()->routeIs('galeria') ? 'active' : '' }}">Galería</a>
            <a href="{{ route('photographers.index') }}" class="{{ request()->routeIs('photographers.*') ? 'active' : '' }}">Fotógrafos</a>
            <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">Sobre Nosotros</a>
            @auth
                @can('admin')
                <a href="/admin/photos/create" class="nav-upload-btn">+ Subir Foto</a>
                @endcan
            @endauth
        </div>
        <button class="global-nav-hamburger" id="globalNavHamburger" aria-label="Abrir menú">
            <span></span><span></span><span></span>
        </button>

        {{-- Menú móvil desplegable --}}
        <div class="global-nav-mobile" id="globalNavMobile">
            <a href="{{ url('/') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Inicio</a>
            <a href="{{ route('galeria') }}" class="{{ request()->routeIs('galeria') ? 'active' : '' }}">Galería</a>
            <a href="{{ route('photographers.index') }}" class="{{ request()->routeIs('photographers.*') ? 'active' : '' }}">Fotógrafos</a>
            <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">Sobre Nosotros</a>
            @auth
                @can('admin')
                <a href="/admin/photos/create" class="nav-upload-btn" style="display:inline-block;width:fit-content;margin-top:0.5rem;">+ Subir Foto</a>
                @endcan
            @endauth
        </div>
    </nav>

    {{-- layout con sidebar + galeria --}}
    <div class="gallery-layout">
        @yield('content')
    </div>

    @stack('scripts')

    <x-floating-actions />

    <script>
    (function() {
        var btn = document.getElementById('globalNavHamburger');
        var menu = document.getElementById('globalNavMobile');
        if (!btn || !menu) return;
        btn.addEventListener('click', function() {
            var isOpen = menu.classList.contains('open');
            btn.classList.toggle('open', !isOpen);
            menu.classList.toggle('open', !isOpen);
        });
        document.addEventListener('click', function(e) {
            if (!btn.contains(e.target) && !menu.contains(e.target)) {
                btn.classList.remove('open');
                menu.classList.remove('open');
            }
        });
    })();
    </script>
</body>
</html>
