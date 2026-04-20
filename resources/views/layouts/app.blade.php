<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fototeca Virtual</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        :root {
            --bg-oscuro: #2b2f35;
            --bg-claro: #efe2cf;
            --text-oscuro: #3a3129;
            --text-claro: #fff9ee;
            --acento: #5c6bc0;
        }
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-claro);
            color: var(--text-oscuro);
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }
        [x-cloak] { display: none !important; }
        nav {
            background-color: var(--bg-oscuro);
            color: var(--text-claro);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            z-index: 10;
        }
        nav a {
            color: var(--text-claro);
            text-decoration: none;
            margin: 0 1rem;
            font-weight: bold;
            transition: color 0.3s;
        }
        nav a:hover, nav a.active {
            color: var(--acento);
        }
        .main-container {
            display: flex;
            flex: 1;
        }
        .sidebar {
            width: 280px;
            background-color: var(--bg-oscuro);
            color: var(--text-claro);
            padding: 2rem 1rem;
            box-sizing: border-box;
        }
        .sidebar h3 {
            color: var(--bg-claro);
            margin-top: 0;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            padding-bottom: 0.5rem;
            text-transform: uppercase;
            font-size: 0.95rem;
            letter-spacing: 1px;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar li {
            margin-bottom: 0.5rem;
        }
        .sidebar a {
            color: var(--text-claro);
            text-decoration: none;
            display: block;
            padding: 0.5rem;
            border-radius: 4px;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: var(--acento);
        }
        .accordion {
            cursor: pointer;
            padding: 0.8rem 0.5rem;
            width: 100%;
            text-align: left;
            border: none;
            outline: none;
            transition: 0.4s;
            background: none;
            color: var(--text-claro);
            font-size: 1rem;
            font-weight: bold;
            border-radius: 4px;
        }
        .accordion:hover, .accordion.active {
            background-color: rgba(255,255,255,0.1);
            color: var(--acento);
        }
        .section-header {
            cursor: pointer;
            padding: 0.5rem 0.5rem;
            width: 100%;
            text-align: left;
            border: none;
            outline: none;
            background: rgba(255,255,255,0.07);
            color: var(--acento);
            font-size: 0.75rem;
            font-weight: bold;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            border-radius: 4px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.4rem;
        }
        .section-header:hover {
            background: rgba(255,255,255,0.12);
        }
        .content {
            flex: 1;
            padding: 2rem;
            background-color: var(--bg-claro);
            box-sizing: border-box;
        }
        .top-bar {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }
        .top-bar a {
            background-color: var(--text-oscuro);
            color: var(--bg-claro);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: bold;
            transition: background 0.3s;
        }
        .top-bar a:hover, .top-bar a.active {
            background-color: var(--acento);
            color: var(--text-claro);
        }
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 2rem;
        }
        .photo-card {
            background-color: #fff;
            border-radius: 4px;
            overflow: hidden;
            box-shadow: 2px 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .photo-card:hover {
            transform: translateY(-4px);
            box-shadow: 4px 8px 16px rgba(0,0,0,0.15);
        }
        .photo-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
        }
        .photo-info {
            padding: 1rem;
            background-color: #faf7f2;
        }
        .photo-info h4 {
            margin: 0 0 0.5rem 0;
            font-size: 1rem;
            color: var(--text-oscuro);
        }
        .photo-info p {
            margin: 0;
            font-size: 0.85rem;
            color: #666;
        }
        @media (max-width: 768px) {
            .main-container { flex-direction: column; }
            .sidebar { width: 100%; padding: 1rem; }
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo"><strong>FOTOTECA DIGITAL</strong></div>
        <div class="menu">
            <a href="{{ route('home') }}">INICIO</a>
            <a href="{{ route('galeria') }}" class="active">GALERÍA</a>
        </div>
    </nav>
    <div class="main-container">
        @yield('content')
    </div>
</body>
</html>
