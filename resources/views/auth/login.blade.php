<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso — Fototeca Digital</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg-oscuro:  #2b2f35;
            --bg-claro:   #efe2cf;
            --text-oscuro:#3a3129;
            --text-claro: #fff9ee;
            --acento:     #5c6bc0;
            --oro:        #c8a96e;
            --hero-bg:    #16130f;
            --serif:      'Playfair Display', Georgia, serif;
            --sans:       'Segoe UI', system-ui, sans-serif;
        }

        body {
            font-family: var(--sans);
            background: var(--hero-bg);
            color: var(--text-claro);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .bg-overlay {
            position: absolute;
            inset: 0;
            background-image: url('https://picsum.photos/seed/fototecaancash/1920/1080');
            background-size: cover;
            background-position: center;
            filter: sepia(0.7) brightness(0.18) contrast(1.1);
            z-index: 0;
        }

        .scanlines {
            position: absolute;
            inset: 0;
            background: repeating-linear-gradient(
                0deg, transparent, transparent 2px,
                rgba(0,0,0,0.06) 2px, rgba(0,0,0,0.06) 4px
            );
            z-index: 1;
            pointer-events: none;
        }

        .login-card {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 420px;
            padding: 2.5rem;
            background: rgba(22, 19, 15, 0.88);
            border: 1px solid rgba(200, 169, 110, 0.2);
            backdrop-filter: blur(12px);
        }

        .login-logo {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-logo h1 {
            font-family: var(--serif);
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--text-claro);
        }

        .login-logo h1 span { color: var(--oro); font-style: italic; }

        .login-logo p {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.4em;
            text-transform: uppercase;
            color: var(--oro);
            margin-top: 0.4rem;
            opacity: 0.7;
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 1.5rem 0;
        }
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(to right, transparent, rgba(200,169,110,0.4), transparent);
        }
        .divider span {
            color: rgba(200,169,110,0.5);
            font-size: 0.7rem;
            letter-spacing: 0.2em;
        }

        .form-group {
            margin-bottom: 1.2rem;
        }

        label {
            display: block;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: rgba(255,249,238,0.5);
            margin-bottom: 0.5rem;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.75rem 1rem;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(200,169,110,0.2);
            color: var(--text-claro);
            font-family: var(--sans);
            font-size: 0.9rem;
            outline: none;
            transition: border-color 0.3s;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: rgba(200,169,110,0.6);
            background: rgba(255,255,255,0.07);
        }

        input::placeholder { color: rgba(255,249,238,0.25); }

        .remember-row {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .remember-row label {
            margin: 0;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            text-transform: none;
            color: rgba(255,249,238,0.4);
            cursor: pointer;
        }

        input[type="checkbox"] {
            accent-color: var(--acento);
            width: 14px;
            height: 14px;
            cursor: pointer;
        }

        .btn-login {
            width: 100%;
            padding: 0.85rem;
            background: var(--acento);
            color: var(--text-claro);
            border: 2px solid var(--acento);
            font-family: var(--sans);
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-login:hover {
            background: transparent;
            color: var(--acento);
        }

        .error-msg {
            background: rgba(220, 38, 38, 0.15);
            border-left: 3px solid rgba(220,38,38,0.6);
            padding: 0.7rem 1rem;
            margin-bottom: 1.2rem;
            font-size: 0.82rem;
            color: #fca5a5;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: rgba(255,249,238,0.25);
            text-decoration: none;
            transition: color 0.3s;
        }

        .back-link:hover { color: var(--oro); }
    </style>
</head>
<body>
    <div class="bg-overlay"></div>
    <div class="scanlines"></div>

    <div class="login-card">
        <div class="login-logo">
            <h1>Foto<span>teca</span></h1>
            <p>Archivo Histórico Visual</p>
        </div>

        <div class="divider"><span>✦</span></div>

        @if ($errors->any())
            <div class="error-msg">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" id="email" name="email"
                       value="{{ old('email') }}"
                       placeholder="correo@ejemplo.com"
                       autocomplete="email" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password"
                       placeholder="••••••••"
                       autocomplete="current-password" required>
            </div>

            <div class="remember-row">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Mantener sesión iniciada</label>
            </div>

            <button type="submit" class="btn-login">Ingresar</button>
        </form>

        <a href="{{ route('home') }}" class="back-link">← Volver al inicio</a>
    </div>
</body>
</html>
