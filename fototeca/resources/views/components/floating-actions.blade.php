<div class="floating-actions">
    <style>
        .floating-actions {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            z-index: 999;
        }
        @media (max-width: 480px) {
            .floating-actions { bottom: 1rem; right: 1rem; gap: 0.75rem; }
            .fab-btn { width: 44px; height: 44px; font-size: 1.25rem; }
        }

        .fab-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            transition: transform 0.3s, box-shadow 0.3s;
            text-decoration: none;
            color: white;
            font-size: 1.5rem;
            position: relative;
        }

        .fab-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px rgba(0,0,0,0.4);
        }

        .fab-whatsapp {
            background-color: #25D366;
        }

        .fab-yape {
            background-color: #742284; /* Yape purple */
        }

        .yape-container {
            position: relative;
        }

        .yape-popup {
            position: absolute;
            bottom: 100%;
            right: 0;
            margin-bottom: 20px;
            width: 200px;
            background: white;
            padding: 1rem;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            text-align: center;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s ease;
            cursor: default;
            pointer-events: none;
        }

        .yape-container:hover .yape-popup {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
            pointer-events: auto;
        }

        .yape-popup::after {
            content: '';
            position: absolute;
            bottom: -10px;
            right: 15px;
            border-width: 10px 10px 0;
            border-style: solid;
            border-color: white transparent transparent transparent;
        }

        .yape-popup img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 0.5rem;
        }

        .yape-popup p {
            color: #333;
            font-size: 0.8rem;
            margin: 0;
            font-family: sans-serif;
            font-weight: bold;
        }
    </style>

    <!-- Yape Button -->
    <div class="yape-container">
        <!-- Popup -->
        <div class="yape-popup">
            <p style="margin-bottom:0.8rem; color:#742284;">Aporte Voluntario</p>
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=Donacion-Yape" alt="QR Yape">
            <p>Yape / Plin</p>
            <p style="font-weight:normal; font-size:0.75rem;">999 888 777</p>
        </div>

        <button class="fab-btn fab-yape" title="Aporte Voluntario con Yape" style="border:none;">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
        </button>
    </div>

    <!-- WhatsApp Button -->
    <a href="https://wa.me/51999888777?text=Hola,%20tengo%20una%20consulta%20sobre%20la%20Fototeca%20Digital" target="_blank" class="fab-btn fab-whatsapp" title="Consultas por WhatsApp">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
    </a>
</div>
