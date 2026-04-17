<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — @yield('title', 'Panel de Administración') | Fototeca Digital</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg-oscuro:  #2b2f35;
            --bg-sidebar: #1e2228;
            --bg-claro:   #efe2cf;
            --bg-crema:   #f7f0e6;
            --text-oscuro:#3a3129;
            --text-claro: #fff9ee;
            --acento:     #5c6bc0;
            --oro:        #c8a96e;
            --danger:     #c0392b;
            --success:    #27ae60;
            --serif:      'Playfair Display', Georgia, serif;
            --sans:       'Segoe UI', system-ui, sans-serif;
            --sidebar-w:  250px;
        }

        [x-cloak] { display: none !important; }

        body {
            font-family: var(--sans);
            background: var(--bg-claro);
            color: var(--text-oscuro);
            display: flex;
            min-height: 100vh;
        }

        /* ── SIDEBAR ────────────────────────────────────────────── */
        .admin-sidebar {
            width: var(--sidebar-w);
            background: var(--bg-sidebar);
            color: var(--text-claro);
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            position: fixed;
            top: 0; bottom: 0; left: 0;
            overflow-y: auto;
            z-index: 50;
        }

        .sidebar-brand {
            padding: 1.5rem 1.2rem 1rem;
            border-bottom: 1px solid rgba(200,169,110,0.15);
        }

        .sidebar-brand a {
            font-family: var(--serif);
            font-size: 1.1rem;
            font-weight: 700;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--text-claro);
            text-decoration: none;
        }

        .sidebar-brand a span { color: var(--oro); font-style: italic; }

        .sidebar-brand p {
            font-size: 0.6rem;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: rgba(200,169,110,0.5);
            margin-top: 0.25rem;
        }

        .sidebar-user {
            padding: 0.8rem 1.2rem;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            font-size: 0.75rem;
        }

        .sidebar-user .user-name {
            font-weight: 700;
            color: var(--text-claro);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar-user .user-role {
            font-size: 0.6rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--oro);
            opacity: 0.7;
        }

        .sidebar-nav {
            flex: 1;
            padding: 1rem 0;
        }

        .nav-section-label {
            font-size: 0.58rem;
            font-weight: 700;
            letter-spacing: 0.35em;
            text-transform: uppercase;
            color: rgba(200,169,110,0.4);
            padding: 0.8rem 1.2rem 0.4rem;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            padding: 0.65rem 1.2rem;
            color: rgba(255,249,238,0.55);
            text-decoration: none;
            font-size: 0.82rem;
            font-weight: 500;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }

        .nav-item:hover {
            color: var(--text-claro);
            background: rgba(255,255,255,0.05);
            border-left-color: rgba(200,169,110,0.3);
        }

        .nav-item.active {
            color: var(--text-claro);
            background: rgba(92,107,192,0.15);
            border-left-color: var(--acento);
        }

        .nav-item .nav-icon {
            font-size: 1rem;
            width: 20px;
            text-align: center;
            flex-shrink: 0;
        }

        .sidebar-footer {
            padding: 1rem 1.2rem;
            border-top: 1px solid rgba(255,255,255,0.06);
        }

        .logout-btn {
            width: 100%;
            padding: 0.6rem;
            background: transparent;
            border: 1px solid rgba(192,57,43,0.3);
            color: rgba(192,57,43,0.7);
            font-family: var(--sans);
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s;
        }

        .logout-btn:hover {
            background: rgba(192,57,43,0.1);
            border-color: rgba(192,57,43,0.6);
            color: #e74c3c;
        }

        /* ── MAIN ───────────────────────────────────────────────── */
        .admin-main {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .admin-topbar {
            background: var(--bg-oscuro);
            color: var(--text-claro);
            padding: 0.9rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid rgba(200,169,110,0.12);
            position: sticky;
            top: 0;
            z-index: 40;
        }

        .topbar-breadcrumb {
            font-size: 0.78rem;
            color: rgba(255,249,238,0.5);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .topbar-breadcrumb .current {
            color: var(--text-claro);
            font-weight: 600;
        }

        .topbar-breadcrumb a {
            color: rgba(255,249,238,0.4);
            text-decoration: none;
            transition: color 0.2s;
        }

        .topbar-breadcrumb a:hover { color: var(--oro); }

        .admin-content {
            flex: 1;
            padding: 2rem;
        }

        /* ── ALERTS ─────────────────────────────────────────────── */
        .alert {
            padding: 0.8rem 1.2rem;
            margin-bottom: 1.5rem;
            font-size: 0.85rem;
            border-left: 4px solid;
        }

        .alert-success {
            background: rgba(39,174,96,0.1);
            border-color: var(--success);
            color: #1e8449;
        }

        .alert-error {
            background: rgba(192,57,43,0.1);
            border-color: var(--danger);
            color: #c0392b;
        }

        /* ── PAGE HEADER ────────────────────────────────────────── */
        .page-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(58,49,41,0.15);
        }

        .page-header h1 {
            font-family: var(--serif);
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text-oscuro);
        }

        .page-header p {
            font-size: 0.82rem;
            color: #888;
            margin-top: 0.25rem;
        }

        .btn {
            display: inline-block;
            padding: 0.55rem 1.4rem;
            font-family: var(--sans);
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.25s;
            border: 2px solid transparent;
        }

        .btn-primary {
            background: var(--acento);
            color: var(--text-claro);
            border-color: var(--acento);
        }

        .btn-primary:hover {
            background: transparent;
            color: var(--acento);
        }

        .btn-secondary {
            background: transparent;
            color: var(--text-oscuro);
            border-color: rgba(58,49,41,0.3);
        }

        .btn-secondary:hover {
            border-color: var(--text-oscuro);
        }

        .btn-danger {
            background: var(--danger);
            color: white;
            border-color: var(--danger);
        }

        .btn-danger:hover {
            background: transparent;
            color: var(--danger);
        }

        .btn-sm {
            padding: 0.35rem 0.9rem;
            font-size: 0.68rem;
        }

        /* ── TABLE ──────────────────────────────────────────────── */
        .table-wrap {
            background: white;
            border: 1px solid rgba(58,49,41,0.1);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
        }

        thead tr {
            background: var(--bg-oscuro);
        }

        th {
            padding: 0.8rem 1rem;
            text-align: left;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: rgba(255,249,238,0.6);
        }

        td {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid rgba(58,49,41,0.07);
            color: var(--text-oscuro);
            vertical-align: middle;
        }

        tbody tr:hover { background: rgba(92,107,192,0.04); }
        tbody tr:last-child td { border-bottom: none; }

        .actions { display: flex; gap: 0.5rem; }

        /* ── FORM ───────────────────────────────────────────────── */
        .form-card {
            background: white;
            border: 1px solid rgba(58,49,41,0.1);
            padding: 2rem;
            max-width: 800px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.2rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
        }

        .form-group.full { grid-column: 1 / -1; }

        label {
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: rgba(58,49,41,0.55);
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="number"],
        input[type="url"],
        select,
        textarea {
            padding: 0.6rem 0.8rem;
            border: 1px solid rgba(58,49,41,0.2);
            background: var(--bg-crema);
            font-family: var(--sans);
            font-size: 0.88rem;
            color: var(--text-oscuro);
            outline: none;
            transition: border-color 0.25s;
            width: 100%;
        }

        input:focus, select:focus, textarea:focus {
            border-color: var(--acento);
            background: white;
        }

        textarea { resize: vertical; min-height: 100px; }

        .form-hint {
            font-size: 0.72rem;
            color: #999;
        }

        .field-error {
            font-size: 0.72rem;
            color: var(--danger);
        }

        .checkbox-row {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .checkbox-row input[type="checkbox"] {
            width: 15px;
            height: 15px;
            accent-color: var(--acento);
        }

        .checkbox-row label {
            font-size: 0.82rem;
            text-transform: none;
            letter-spacing: normal;
            color: var(--text-oscuro);
            cursor: pointer;
        }

        .form-divider {
            grid-column: 1 / -1;
            height: 1px;
            background: rgba(58,49,41,0.1);
            margin: 0.5rem 0;
        }

        .form-section-title {
            grid-column: 1 / -1;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: var(--oro);
            padding-top: 0.5rem;
        }

        /* ── BADGE ──────────────────────────────────────────────── */
        .badge {
            display: inline-block;
            padding: 0.2rem 0.6rem;
            font-size: 0.62rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        .badge-published { background: rgba(39,174,96,0.12); color: #1e8449; }
        .badge-draft     { background: rgba(152,152,152,0.12); color: #777; }
        .badge-admin     { background: rgba(92,107,192,0.12); color: var(--acento); }
        .badge-super     { background: rgba(200,169,110,0.15); color: #9a7a3a; }
        .badge-user      { background: rgba(58,49,41,0.08); color: #888; }

        /* ── SEARCH BAR ─────────────────────────────────────────── */
        .search-bar {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .search-bar input {
            flex: 1;
            max-width: 320px;
        }

        /* ── PAGINATION ─────────────────────────────────────────── */
        .pagination-wrap {
            margin-top: 1.5rem;
            display: flex;
            justify-content: flex-end;
            font-size: 0.8rem;
        }

        .pagination-wrap nav { display: flex; gap: 0.25rem; }

        /* ── THUMBNAIL ──────────────────────────────────────────── */
        .thumb {
            width: 50px;
            height: 38px;
            object-fit: cover;
            display: block;
            filter: sepia(0.2);
        }

        /* ── RESPONSIVE ─────────────────────────────────────────── */
        .admin-sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.55);
            z-index: 49;
            backdrop-filter: blur(2px);
        }
        .admin-sidebar-overlay.visible { display: block; }

        .admin-topbar-hamburger {
            display: none;
            flex-direction: column;
            gap: 4px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 6px;
            border-radius: 4px;
            margin-right: 0.75rem;
        }
        .admin-topbar-hamburger span {
            display: block;
            width: 20px;
            height: 2px;
            background: rgba(255,249,238,0.7);
            border-radius: 1px;
        }

        @media (max-width: 768px) {
            .admin-sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            .admin-sidebar.sidebar-open { transform: translateX(0); }
            .admin-main { margin-left: 0; }
            .form-grid { grid-template-columns: 1fr; }
            .admin-topbar-hamburger { display: flex; }
            .admin-topbar { padding: 0.9rem 1rem; }
            .admin-content { padding: 1.25rem 1rem; }
            .page-header { flex-direction: column; align-items: flex-start; gap: 0.75rem; }
        }
        @media (max-width: 480px) {
            .search-bar { flex-direction: column; }
            .search-bar input { max-width: 100%; }
            table { font-size: 0.78rem; }
            th, td { padding: 0.6rem 0.6rem; }
        }
    </style>
</head>
<body>
    <!-- SIDEBAR -->
    <aside class="admin-sidebar">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">Foto<span>teca</span></a>
            <p>Panel de Administración</p>
        </div>

        <div class="sidebar-user">
            <div class="user-name">{{ auth()->user()->name }}</div>
            <div class="user-role">
                {{ auth()->user()->isSuperAdmin() ? 'Super Administrador' : 'Administrador' }}
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-label">General</div>

            <a href="{{ route('admin.dashboard') }}"
               class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="nav-icon">◈</span> Dashboard
            </a>

            <div class="nav-section-label">Colección</div>

            <a href="{{ route('admin.fotos.index') }}"
               class="nav-item {{ request()->routeIs('admin.fotos.*') ? 'active' : '' }}">
                <span class="nav-icon">⊡</span> Fotografías
            </a>

            <a href="{{ route('admin.fotografos.index') }}"
               class="nav-item {{ request()->routeIs('admin.fotografos.*') ? 'active' : '' }}">
                <span class="nav-icon">◉</span> Fotógrafos
            </a>

            <a href="{{ route('admin.categorias.index') }}"
               class="nav-item {{ request()->routeIs('admin.categorias.*') ? 'active' : '' }}">
                <span class="nav-icon">▦</span> Categorías
            </a>

            <a href="{{ route('admin.etiquetas.index') }}"
               class="nav-item {{ request()->routeIs('admin.etiquetas.*') ? 'active' : '' }}">
                <span class="nav-icon">◇</span> Etiquetas
            </a>

            <div class="nav-section-label">Geografía</div>

            <a href="{{ route('admin.ubicaciones.index') }}"
               class="nav-item {{ request()->routeIs('admin.ubicaciones.*') ? 'active' : '' }}">
                <span class="nav-icon">◎</span> Ubicaciones
            </a>

            @if(auth()->user()->isSuperAdmin())
            <div class="nav-section-label">Sistema</div>

            <a href="{{ route('admin.usuarios.index') }}"
               class="nav-item {{ request()->routeIs('admin.usuarios.*') ? 'active' : '' }}">
                <span class="nav-icon">◐</span> Usuarios
            </a>
            @endif

            <div class="nav-section-label">Sitio</div>

            <a href="{{ route('home') }}" target="_blank" class="nav-item">
                <span class="nav-icon">↗</span> Ver Sitio
            </a>
        </nav>

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">Cerrar sesión</button>
            </form>
        </div>
    </aside>

    <div class="admin-sidebar-overlay" id="adminOverlay"></div>

    <!-- MAIN -->
    <div class="admin-main">
        <div class="admin-topbar">
            <div style="display:flex;align-items:center;">
                <button class="admin-topbar-hamburger" id="adminHamburger" aria-label="Abrir menú">
                    <span></span><span></span><span></span>
                </button>
                <div class="topbar-breadcrumb">
                    <a href="{{ route('admin.dashboard') }}">Admin</a>
                    <span>›</span>
                    <span class="current">@yield('title', 'Dashboard')</span>
                </div>
            </div>
        </div>

        <div class="admin-content">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->has('error'))
                <div class="alert alert-error">{{ $errors->first('error') }}</div>
            @endif

            @yield('content')
        </div>
    </div>

    <script>
    (function() {
        var sidebar = document.querySelector('.admin-sidebar');
        var overlay = document.getElementById('adminOverlay');
        var hamburger = document.getElementById('adminHamburger');
        if (!hamburger) return;
        function openSidebar() {
            sidebar.classList.add('sidebar-open');
            overlay.classList.add('visible');
            document.body.style.overflow = 'hidden';
        }
        function closeSidebar() {
            sidebar.classList.remove('sidebar-open');
            overlay.classList.remove('visible');
            document.body.style.overflow = '';
        }
        hamburger.addEventListener('click', function() {
            sidebar.classList.contains('sidebar-open') ? closeSidebar() : openSidebar();
        });
        overlay.addEventListener('click', closeSidebar);
    })();
    </script>
</body>
</html>
