<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fototeca Digital — Archivo Histórico Visual de Ancash</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&family=Crimson+Text:ital@0;1&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg-oscuro:  #2b2f35;
            --bg-claro:   #efe2cf;
            --bg-crema:   #f7f0e6;
            --text-oscuro:#3a3129;
            --text-claro: #fff9ee;
            --acento:     #5c6bc0;
            --oro:        #c8a96e;
            --hero-bg:    #16130f;
            --serif:      'Playfair Display', Georgia, serif;
            --sans:       'Segoe UI', system-ui, sans-serif;
        }

        [x-cloak] { display: none !important; }

        body {
            font-family: var(--sans);
            background: var(--bg-claro);
            color: var(--text-oscuro);
        }

        /* ── NAV ─────────────────────────────────────────────────── */
        .nav-home {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 100;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.2rem 2.5rem;
            background: transparent;
            transition: background 0.4s, backdrop-filter 0.4s;
        }
        .nav-home.scrolled {
            background: rgba(22,19,15,0.95);
            backdrop-filter: blur(8px);
        }
        .nav-logo {
            font-family: var(--serif);
            font-size: 1.1rem;
            font-weight: 700;
            letter-spacing: 0.25em;
            color: var(--text-claro);
            text-decoration: none;
            text-transform: uppercase;
        }
        .nav-logo span { color: var(--oro); font-style: italic; }
        .nav-links { display: flex; gap: 0.5rem; }
        .nav-links a {
            color: rgba(255,249,238,0.7);
            text-decoration: none;
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            padding: 0.4rem 0.9rem;
            border: 1px solid transparent;
            transition: all 0.3s;
        }
        .nav-links a:hover, .nav-links a.active {
            color: var(--text-claro);
            border-color: rgba(200,169,110,0.4);
        }

        /* Hamburger */
        .nav-hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 6px;
            z-index: 110;
        }
        .nav-hamburger span {
            display: block;
            width: 22px;
            height: 2px;
            background: var(--text-claro);
            border-radius: 1px;
            transition: transform 0.3s, opacity 0.3s;
        }
        .nav-hamburger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
        .nav-hamburger.open span:nth-child(2) { opacity: 0; }
        .nav-hamburger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

        /* Mobile nav overlay */
        .nav-mobile-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(22,19,15,0.6);
            z-index: 98;
            backdrop-filter: blur(2px);
        }
        .nav-mobile-overlay.visible { display: block; }

        /* Mobile nav panel */
        .nav-mobile-menu {
            display: none;
            position: fixed;
            top: 0; right: 0;
            width: min(280px, 85vw);
            height: 100vh;
            background: rgba(22,19,15,0.98);
            backdrop-filter: blur(12px);
            z-index: 105;
            flex-direction: column;
            padding: 5rem 2rem 2rem;
            gap: 0.5rem;
            transform: translateX(100%);
            transition: transform 0.35s ease;
            border-left: 1px solid rgba(200,169,110,0.15);
        }
        .nav-mobile-menu.open {
            display: flex;
            transform: translateX(0);
        }
        .nav-mobile-menu a {
            color: rgba(255,249,238,0.75);
            text-decoration: none;
            font-size: 1rem;
            font-weight: 600;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            padding: 0.85rem 0;
            border-bottom: 1px solid rgba(200,169,110,0.1);
            transition: color 0.2s;
        }
        .nav-mobile-menu a:hover, .nav-mobile-menu a.active {
            color: var(--oro);
        }


        /* ── GLOBAL SECTION UTILITIES ─────────────────────────────── */
        .section-dark  { background: var(--bg-oscuro); color: var(--text-claro); }
        .section-hero  { background: var(--hero-bg); }
        .section-cream { background: var(--bg-crema); color: var(--text-oscuro); }
        .section-ink   { background: #1a1610; color: var(--text-claro); }

        .section-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 5rem 2rem;
        }

        .section-tag {
            display: inline-block;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.35em;
            text-transform: uppercase;
            color: var(--oro);
            border-bottom: 1px solid var(--oro);
            padding-bottom: 0.2em;
            margin-bottom: 1.2rem;
        }

        .section-title {
            font-family: var(--serif);
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 700;
            line-height: 1.1;
            margin-bottom: 1rem;
        }

        .section-subtitle {
            font-family: var(--sans);
            font-size: 1rem;
            line-height: 1.7;
            opacity: 0.65;
            max-width: 560px;
        }

        .divider-oro {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 1.5rem 0;
        }
        .divider-oro::before, .divider-oro::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(to right, transparent, var(--oro), transparent);
        }
        .divider-oro span {
            color: var(--oro);
            font-size: 0.8rem;
            opacity: 0.8;
        }

        /* ── HERO ─────────────────────────────────────────────────── */
        .hero {
            position: relative;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }
        .hero-bg {
            position: absolute;
            inset: 0;
            background-image: url('https://picsum.photos/seed/panoramica1960/1920/1080');
            background-size: cover;
            background-position: center;
            filter: sepia(0.6) brightness(0.25) contrast(1.1);
        }
        .hero-overlay {
            position: absolute;
            inset: 0;
            background:
                linear-gradient(to bottom, rgba(22,19,15,0.5) 0%, rgba(22,19,15,0.3) 40%, rgba(22,19,15,0.75) 80%, rgba(22,19,15,1) 100%),
                radial-gradient(ellipse 70% 60% at 50% 40%, rgba(92,107,192,0.08) 0%, transparent 70%);
        }
        /* Scan-line texture */
        .hero-scanlines {
            position: absolute;
            inset: 0;
            background: repeating-linear-gradient(
                0deg, transparent, transparent 2px,
                rgba(0,0,0,0.04) 2px, rgba(0,0,0,0.04) 4px
            );
            pointer-events: none;
        }

        /* ── HERO BG: KEN BURNS + PARALLAX ──────────────────────────── */
        .hero-bg {
            animation: kenBurns 28s ease-in-out infinite alternate;
            transform-origin: center center;
        }
        @keyframes kenBurns {
            0%   { transform: scale(1.08) translate(0px, 0px); }
            33%  { transform: scale(1.14) translate(-12px, -8px); }
            66%  { transform: scale(1.10) translate(10px, -5px); }
            100% { transform: scale(1.08) translate(-5px, 6px); }
        }

        /* vignette estatica, sin pulsacion */
        .hero-overlay {
            opacity: 1;
        }

        /* ── SHUTTER OVERLAY: apertura de camara al cargar ─────────── */
        #shutter-overlay {
            position: fixed;
            inset: 0;
            z-index: 9999;
            pointer-events: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .shutter-blade {
            position: absolute;
            background: #0a0806;
            transition: transform 1.2s cubic-bezier(0.77, 0, 0.18, 1);
        }
        /* 4 hojas: arriba, abajo, izq, der */
        #shutter-top    { top: 0; left: 0; right: 0; height: 50%; transform: translateY(0); }
        #shutter-bottom { bottom: 0; left: 0; right: 0; height: 50%; transform: translateY(0); }
        #shutter-left   { left: 0; top: 0; bottom: 0; width: 50%; transform: translateX(0); }
        #shutter-right  { right: 0; top: 0; bottom: 0; width: 50%; transform: translateX(0); }

        #shutter-overlay.open #shutter-top    { transform: translateY(-100%); }
        #shutter-overlay.open #shutter-bottom { transform: translateY(100%); }
        #shutter-overlay.open #shutter-left   { transform: translateX(-100%); }
        #shutter-overlay.open #shutter-right  { transform: translateX(100%); }

        /* lente central decorativa en el shutter */
        .shutter-lens {
            position: absolute;
            z-index: 10000;
            width: 140px;
            height: 140px;
            border-radius: 50%;
            border: 2px solid rgba(200,169,110,0.6);
            box-shadow:
                0 0 0 10px rgba(10,8,6,0.95),
                0 0 0 11px rgba(200,169,110,0.2),
                0 0 0 30px rgba(10,8,6,0.8),
                0 0 0 31px rgba(200,169,110,0.1),
                0 0 60px rgba(200,169,110,0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            animation: lensRotate 2s linear infinite;
            transition: opacity 1s;
        }
        @keyframes lensRotate {
            to { transform: rotate(360deg); }
        }
        .shutter-lens::after {
            content: '';
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 1px solid rgba(200,169,110,0.4);
            box-shadow: inset 0 0 20px rgba(200,169,110,0.1);
            animation: lensRotate 3s linear infinite reverse;
        }
        #shutter-overlay.open .shutter-lens {
            opacity: 0;
        }

        /* ── CANVAS DE PARTICULAS (polvo fotografico) ──────────────── */
        #dust-canvas {
            position: absolute;
            inset: 0;
            z-index: 3;
            pointer-events: none;
        }

        /* ── FILMSTRIP SCROLL CONTINUO ───────────────────────────────── */
        .filmstrip-track {
            display: flex;
            animation: filmScroll 18s linear infinite;
            width: max-content;
        }
        @keyframes filmScroll {
            from { transform: translateX(0); }
            to   { transform: translateX(-50%); }
        }
        .filmstrip {
            overflow: hidden;
        }
        .filmstrip:hover .filmstrip-track {
            animation-play-state: paused;
        }

        /* contador de frames estilo pelicula */
        .hero-frame-counter {
            position: absolute;
            bottom: 135px;
            left: 2rem;
            z-index: 4;
            font-family: 'Courier New', monospace;
            font-size: 0.65rem;
            color: rgba(200,169,110,0.5);
            letter-spacing: 0.15em;
            user-select: none;
        }

        /* crosshair decorativo en hero */
        .hero-crosshair {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
            pointer-events: none;
            opacity: 0.06;
        }

        /* badge de exposicion (como info de camara) */
        .hero-exposure {
            position: absolute;
            bottom: 140px;
            right: 2rem;
            z-index: 4;
            font-family: 'Courier New', monospace;
            font-size: 0.6rem;
            color: rgba(200,169,110,0.45);
            letter-spacing: 0.1em;
            text-align: right;
            line-height: 1.7;
            user-select: none;
        }

        /* fade-in del contenido del hero */
        .hero-eyebrow, .hero-title, .divider-oro, .hero-subtitle, .hero-desc, .hero-actions {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }
        .hero-content-visible .hero-eyebrow  { opacity: 1; transform: translateY(0); transition-delay: 0s; }
        .hero-content-visible .hero-title    { opacity: 1; transform: translateY(0); transition-delay: 0.15s; }
        .hero-content-visible .divider-oro   { opacity: 1; transform: translateY(0); transition-delay: 0.3s; }
        .hero-content-visible .hero-subtitle { opacity: 1; transform: translateY(0); transition-delay: 0.4s; }
        .hero-content-visible .hero-desc     { opacity: 1; transform: translateY(0); transition-delay: 0.55s; }
        .hero-content-visible .hero-actions  { opacity: 1; transform: translateY(0); transition-delay: 0.7s; }

        .hero-body {
            position: relative;
            z-index: 2;
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 8rem 2rem 10rem;
        }

        .hero-eyebrow {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.5em;
            text-transform: uppercase;
            color: var(--oro);
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .hero-title {
            font-family: var(--serif);
            font-size: clamp(4rem, 10vw, 9rem);
            font-weight: 900;
            letter-spacing: 0.15em;
            line-height: 0.85;
            color: var(--text-claro);
            text-transform: uppercase;
        }
        .hero-title-italic {
            display: block;
            font-weight: 400;
            font-style: italic;
            font-size: 0.45em;
            letter-spacing: 0.35em;
            color: var(--oro);
            text-transform: none;
            margin-top: 0.4em;
        }

        .hero-subtitle {
            margin-top: 2.5rem;
            font-size: 0.75rem;
            letter-spacing: 0.4em;
            text-transform: uppercase;
            color: rgba(255,249,238,0.5);
        }

        .hero-desc {
            margin-top: 1.5rem;
            font-family: var(--sans);
            font-size: 1.05rem;
            line-height: 1.8;
            color: rgba(255,249,238,0.65);
            max-width: 520px;
        }

        .hero-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 2.5rem;
        }

        .btn-primary {
            display: inline-block;
            padding: 0.85rem 2.5rem;
            background: var(--acento);
            color: var(--text-claro);
            text-decoration: none;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            border: 2px solid var(--acento);
            transition: all 0.3s;
        }
        .btn-primary:hover {
            background: transparent;
            color: var(--acento);
        }

        .btn-ghost {
            display: inline-block;
            padding: 0.85rem 2.5rem;
            background: transparent;
            color: var(--oro);
            text-decoration: none;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            border: 2px solid rgba(200,169,110,0.35);
            transition: all 0.3s;
        }
        .btn-ghost:hover {
            border-color: var(--oro);
            background: rgba(200,169,110,0.08);
        }

        /* Film strip */
        .filmstrip {
            position: relative;
            z-index: 2;
            display: flex;
            height: 110px;
            background: #0a0907;
            border-top: 10px solid #0a0907;
            border-bottom: 10px solid #0a0907;
            overflow: hidden;
            flex-shrink: 0;
        }
        .filmstrip-holes {
            position: absolute;
            top: 0; bottom: 0; left: 0; right: 0;
            background:
                repeating-linear-gradient(90deg,
                    transparent 0px, transparent 10px,
                    #0a0907 10px, #0a0907 14px
                );
            z-index: 3;
            pointer-events: none;
            mix-blend-mode: multiply;
        }
        .filmstrip-frame {
            flex-shrink: 0;
            width: 160px;
            border-left: 3px solid #0a0907;
            overflow: hidden;
            position: relative;
            cursor: pointer;
        }
        .filmstrip-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: sepia(0.7) contrast(0.85) brightness(0.6);
            transition: filter 0.5s, transform 0.5s;
            display: block;
        }
        .filmstrip-frame:hover img {
            filter: sepia(0.1) contrast(1) brightness(0.85);
            transform: scale(1.05);
        }

        /* ── STATS ────────────────────────────────────────────────── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 0;
        }
        .stat-item {
            padding: 4rem 2rem;
            text-align: center;
            border-right: 1px solid rgba(255,255,255,0.07);
            position: relative;
        }
        .stat-item:last-child { border-right: none; }
        .stat-number {
            display: block;
            font-family: var(--serif);
            font-size: clamp(3rem, 5vw, 5rem);
            font-weight: 700;
            color: var(--oro);
            line-height: 1;
        }
        .stat-label {
            display: block;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: rgba(255,249,238,0.45);
            margin-top: 0.8rem;
        }

        /* ── EPOCHS ───────────────────────────────────────────────── */
        .epochs-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
            margin-top: 3rem;
        }
        .epoch-card {
            position: relative;
            display: block;
            text-decoration: none;
            overflow: hidden;
            aspect-ratio: 3/4;
        }
        .epoch-image {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            filter: sepia(0.5) contrast(0.9) brightness(0.55);
            transition: filter 0.5s, transform 0.7s;
        }
        .epoch-card:hover .epoch-image {
            filter: sepia(0.1) contrast(1) brightness(0.45);
            transform: scale(1.04);
        }
        .epoch-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top,
                rgba(22,19,15,0.95) 0%,
                rgba(22,19,15,0.4) 50%,
                rgba(22,19,15,0.1) 100%
            );
        }
        .epoch-info {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            padding: 2rem 1.5rem;
        }
        .epoch-years {
            display: block;
            font-size: 0.6rem;
            font-weight: 700;
            letter-spacing: 0.35em;
            text-transform: uppercase;
            color: var(--oro);
            margin-bottom: 0.6rem;
        }
        .epoch-info h3 {
            font-family: var(--serif);
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--text-claro);
            line-height: 1.2;
            margin-bottom: 0.8rem;
        }
        .epoch-count {
            font-size: 0.75rem;
            color: rgba(255,249,238,0.5);
            letter-spacing: 0.05em;
        }
        .epoch-link {
            display: block;
            margin-top: 1rem;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--acento);
            opacity: 0;
            transform: translateY(8px);
            transition: opacity 0.3s, transform 0.3s;
        }
        .epoch-card:hover .epoch-link {
            opacity: 1;
            transform: translateY(0);
        }

        /* ── FEATURED PHOTOS ──────────────────────────────────────── */
        .photos-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: repeat(2, 260px);
            gap: 4px;
            margin-top: 3rem;
        }
        .photo-item {
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }
        .photo-item:first-child {
            grid-column: span 2;
            grid-row: span 2;
        }
        .photo-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            filter: sepia(0.15) contrast(0.95);
            transition: transform 0.6s, filter 0.4s;
        }
        .photo-item:hover img {
            transform: scale(1.04);
            filter: sepia(0) contrast(1);
        }
        .photo-item-caption {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            padding: 1.5rem 1.2rem 1rem;
            background: linear-gradient(to top, rgba(22,19,15,0.9) 0%, transparent 100%);
            transform: translateY(4px);
            opacity: 0;
            transition: opacity 0.3s, transform 0.3s;
        }
        .photo-item:hover .photo-item-caption {
            opacity: 1;
            transform: translateY(0);
        }
        .photo-item-caption h4 {
            font-family: var(--serif);
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-claro);
            margin-bottom: 0.3rem;
        }
        .photo-item-caption p {
            font-size: 0.75rem;
            color: rgba(255,249,238,0.6);
        }

        .section-cta {
            text-align: center;
            margin-top: 3rem;
        }

        /* ── PHOTOGRAPHERS ────────────────────────────────────────── */
        .photographers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.5rem;
            margin-top: 3rem;
        }
        .photographer-card {
            display: flex;
            gap: 1.5rem;
            align-items: flex-start;
            background: white;
            padding: 1.8rem;
            border-left: 3px solid var(--acento);
            box-shadow: 0 2px 12px rgba(58,49,41,0.08);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .photographer-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(58,49,41,0.13);
        }
        .photographer-avatar {
            flex-shrink: 0;
            width: 64px;
            height: 64px;
            background: var(--bg-oscuro);
            color: var(--oro);
            font-family: var(--serif);
            font-size: 1.8rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .photographer-info { flex: 1; min-width: 0; }
        .photographer-name {
            font-family: var(--serif);
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-oscuro);
            margin-bottom: 0.3rem;
        }
        .photographer-meta {
            display: flex;
            gap: 0.8rem;
            flex-wrap: wrap;
            margin-bottom: 0.8rem;
        }
        .photographer-meta span {
            font-size: 0.7rem;
            letter-spacing: 0.05em;
            color: #888;
        }
        .photographer-bio {
            font-size: 0.82rem;
            line-height: 1.65;
            color: #666;
            margin-bottom: 0.9rem;
        }
        .photographer-count {
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            color: var(--acento);
            text-transform: uppercase;
        }

        /* ── MISSION ──────────────────────────────────────────────── */
        .mission-inner {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 6rem;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 6rem 2rem;
        }
        .mission-quote {
            position: relative;
            padding-left: 2rem;
            border-left: 2px solid var(--oro);
        }
        .quote-mark {
            font-family: var(--serif);
            font-size: 8rem;
            line-height: 0.5;
            color: var(--oro);
            opacity: 0.25;
            display: block;
            margin-bottom: 1rem;
        }
        .mission-quote p {
            font-family: var(--serif);
            font-size: 1.35rem;
            font-style: italic;
            line-height: 1.7;
            color: var(--text-claro);
        }
        .mission-quote cite {
            display: block;
            margin-top: 1.5rem;
            font-size: 0.7rem;
            font-style: normal;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--oro);
            opacity: 0.7;
        }
        .mission-text .section-title {
            font-family: var(--serif);
            font-size: 2.2rem;
            color: var(--text-claro);
            margin-bottom: 1.5rem;
        }
        .mission-text p {
            font-size: 0.95rem;
            line-height: 1.8;
            color: rgba(255,249,238,0.6);
            margin-bottom: 1.2rem;
        }

        /* ── FOOTER ───────────────────────────────────────────────── */
        .footer {
            background: #0f0d0a;
            color: rgba(255,249,238,0.3);
            text-align: center;
            padding: 2rem;
            font-size: 0.75rem;
            letter-spacing: 0.1em;
        }
        .footer strong { color: var(--oro); }

        /* ── RESPONSIVE ───────────────────────────────────────────── */
        @media (max-width: 900px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .epochs-grid { grid-template-columns: repeat(2, 1fr); }
            .photos-grid {
                grid-template-columns: 1fr 1fr;
                grid-template-rows: auto;
            }
            .photo-item:first-child { grid-column: span 2; grid-row: span 1; }
            .mission-inner { grid-template-columns: 1fr; gap: 3rem; }
        }
        @media (max-width: 768px) {
            .nav-links { display: none; }
            .nav-hamburger { display: flex; }
            .nav-home { padding: 1rem 1.5rem; }
        }
        @media (max-width: 600px) {
            .epochs-grid { grid-template-columns: 1fr 1fr; }
            .stats-grid { grid-template-columns: 1fr 1fr; }
            .photos-grid { grid-template-columns: 1fr; }
            .photo-item:first-child { grid-column: span 1; }
            .filmstrip { height: 70px; }
            .nav-home { padding: 0.9rem 1.2rem; }
            .photographers-grid { grid-template-columns: 1fr; }
            .section-inner { padding: 3rem 1.2rem; }
            .hero-body { padding: 7rem 1.5rem 8rem; }
            .hero-actions { flex-direction: column; align-items: center; }
            .hero-actions a { width: 100%; max-width: 280px; text-align: center; }
        }
        @media (max-width: 480px) {
            .epochs-grid { grid-template-columns: 1fr; }
            .stat-item { padding: 2.5rem 1rem; }
            .mission-inner { padding: 3rem 1.2rem; }
            .hero-title { font-size: clamp(3rem, 14vw, 5rem); }
            .filmstrip { height: 55px; }
        }
    </style>
</head>
<body>
    <nav class="nav-home" x-data x-on:scroll.window="$el.classList.toggle('scrolled', window.scrollY > 60)">
        <a href="{{ route('home') }}" class="nav-logo">Foto<span>teca</span></a>
        <div class="nav-links">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Inicio</a>
            <a href="{{ route('galeria') }}" class="{{ request()->routeIs('galeria') ? 'active' : '' }}">Galería</a>
            <a href="{{ route('photographers.index') }}" class="{{ request()->routeIs('photographers.*') ? 'active' : '' }}">Fotógrafos</a>
            <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">Sobre Nosotros</a>
        </div>
        <button class="nav-hamburger" id="navHamburger" aria-label="Abrir menú">
            <span></span><span></span><span></span>
        </button>
    </nav>

    <div class="nav-mobile-overlay" id="navOverlay"></div>
    <div class="nav-mobile-menu" id="navMobileMenu">
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Inicio</a>
        <a href="{{ route('galeria') }}" class="{{ request()->routeIs('galeria') ? 'active' : '' }}">Galería</a>
        <a href="{{ route('photographers.index') }}" class="{{ request()->routeIs('photographers.*') ? 'active' : '' }}">Fotógrafos</a>
        <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">Sobre Nosotros</a>
    </div>

    @yield('content')

    <footer class="footer">
        <p><strong>Fototeca Digital</strong> — Archivo Histórico Visual de Ancash, Perú</p>
        <p style="margin-top:.5rem;">Preservando la memoria visual del Callejón de Huaylas</p>
    </footer>

    <x-floating-actions />

    <script>
    (function() {
        // ── nav hamburguesa ───────────────────────────────────────────
        const btn = document.getElementById('navHamburger');
        const menu = document.getElementById('navMobileMenu');
        const overlay = document.getElementById('navOverlay');
        function open() {
            btn.classList.add('open');
            menu.classList.add('open');
            overlay.classList.add('visible');
            document.body.style.overflow = 'hidden';
        }
        function close() {
            btn.classList.remove('open');
            menu.classList.remove('open');
            overlay.classList.remove('visible');
            document.body.style.overflow = '';
        }
        btn.addEventListener('click', function() {
            menu.classList.contains('open') ? close() : open();
        });
        overlay.addEventListener('click', close);
    })();

    // ── AÑO EN BADGE DE EXPOSICION ────────────────────────────────────
    document.getElementById('heroYear').textContent = new Date().getFullYear();

    // ── SHUTTER OVERLAY: apertura cinematografica ─────────────────────
    (function() {
        // crear shutter dinámicamente
        const overlay = document.createElement('div');
        overlay.id = 'shutter-overlay';
        ['top','bottom','left','right'].forEach(side => {
            const blade = document.createElement('div');
            blade.className = 'shutter-blade';
            blade.id = 'shutter-' + side;
            overlay.appendChild(blade);
        });
        // lente central
        const lens = document.createElement('div');
        lens.className = 'shutter-lens';
        overlay.appendChild(lens);
        document.body.appendChild(overlay);

        // click en lente emite sonido de clic (sin audio, solo visual)
        lens.style.cursor = 'pointer';

        // abrir shutter al cargar
        setTimeout(() => { overlay.classList.add('open'); }, 200);
        // remover del DOM despues de completar
        setTimeout(() => { overlay.style.display = 'none'; }, 1700);

        // activar fade-in del hero body
        setTimeout(() => {
            const heroBody = document.querySelector('.hero-body');
            if (heroBody) heroBody.classList.add('hero-content-visible');
        }, 900);
    })();

    // ── CONTADOR DE FRAMES (ticker) ────────────────────────────────────
    (function() {
        const el = document.getElementById('frameCounter');
        if (!el) return;
        let frame = 1;
        setInterval(() => {
            frame = (frame % 9999) + 1;
            const frameStr = String(frame).padStart(4, '0');
            el.textContent = `FRAME ${frameStr} · ROLL 01 · 35mm`;
        }, 80);
    })();

    // ── PARALLAX DEL HERO-BG con movimiento del mouse ─────────────────
    (function() {
        const heroBg = document.querySelector('.hero-bg');
        if (!heroBg) return;
        let tX = 0, tY = 0, cX = 0, cY = 0;
        document.addEventListener('mousemove', e => {
            const { innerWidth: w, innerHeight: h } = window;
            tX = (e.clientX / w - 0.5) * -18;
            tY = (e.clientY / h - 0.5) * -12;
        });
        function rafLoop() {
            cX += (tX - cX) * 0.04;
            cY += (tY - cY) * 0.04;
            // combinar con la animacion ken burns via CSS var
            heroBg.style.setProperty('--mx', `${cX}px`);
            heroBg.style.setProperty('--my', `${cY}px`);
            // aplicar translate adicional al mouse
            heroBg.style.marginLeft = `${cX * 0.5}px`;
            heroBg.style.marginTop  = `${cY * 0.5}px`;
            requestAnimationFrame(rafLoop);
        }
        rafLoop();
    })();

    // ── PARTICULAS DE POLVO FOTOGRAFICO (canvas) ──────────────────────
    (function() {
        const canvas = document.getElementById('dust-canvas');
        if (!canvas) return;
        const ctx = canvas.getContext('2d');

        function resize() {
            canvas.width  = canvas.offsetWidth;
            canvas.height = canvas.offsetHeight;
        }
        resize();
        window.addEventListener('resize', resize);

        // crear particulas
        const N = 80;
        const particles = Array.from({ length: N }, () => ({
            x: Math.random() * canvas.width,
            y: Math.random() * canvas.height,
            r: Math.random() * 1.8 + 0.2,
            vx: (Math.random() - 0.5) * 0.3,
            vy: (Math.random() - 0.5) * 0.2 - 0.1,
            alpha: Math.random() * 0.4 + 0.05,
            flicker: Math.random() * Math.PI * 2,
        }));

        function draw() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            const t = performance.now() / 1000;
            particles.forEach(p => {
                p.x += p.vx;
                p.y += p.vy;
                p.flicker += 0.04;
                // wrap
                if (p.x < 0) p.x = canvas.width;
                if (p.x > canvas.width) p.x = 0;
                if (p.y < 0) p.y = canvas.height;
                if (p.y > canvas.height) p.y = 0;
                const a = p.alpha * (0.6 + 0.4 * Math.sin(p.flicker));
                ctx.beginPath();
                ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
                ctx.fillStyle = `rgba(200,169,110,${a})`;
                ctx.fill();
            });
            requestAnimationFrame(draw);
        }
        draw();
    })();

    // ── CROSSHAIR: rotacion suave con scroll ──────────────────────────
    (function() {
        const cross = document.querySelector('.hero-crosshair');
        if (!cross) return;
        window.addEventListener('scroll', () => {
            const deg = (window.scrollY * 0.03) % 360;
            cross.style.transform = `translate(-50%, -50%) rotate(${deg}deg)`;
        });
    })();
    </script>
</body>
</html>
