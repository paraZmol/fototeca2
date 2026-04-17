@extends('layouts.gallery')

@section('title', 'Sobre Nosotros - Fototeca Digital Ancashina')

@push('scripts')
<style>
    .about-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 4rem 2rem;
    }
    
    .about-header {
        text-align: center;
        margin-bottom: 4rem;
    }
    
    .about-title {
        font-family: 'Playfair Display', serif;
        font-size: 3.5rem;
        color: var(--sepia-light);
        margin-bottom: 1rem;
        line-height: 1.1;
    }
    
    .about-subtitle {
        font-family: 'Libre Baskerville', serif;
        font-style: italic;
        font-size: 1.2rem;
        color: var(--text-accent);
    }
    
    .about-section {
        margin-bottom: 4rem;
        background: var(--bg-card);
        border: 1px solid var(--border-medium);
        padding: 3rem;
        border-radius: var(--radius-card);
        position: relative;
    }
    
    .about-section::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; height: 3px;
        background: linear-gradient(90deg, transparent, var(--wood-mid), transparent);
    }
    
    .section-heading {
        font-family: 'Playfair Display', serif;
        color: var(--text-primary);
        font-size: 2rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .section-heading::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--border-subtle);
    }
    
    .about-text {
        font-size: 1.05rem;
        line-height: 1.8;
        color: var(--text-secondary);
        margin-bottom: 1.5rem;
    }
    
    .about-text:last-child {
        margin-bottom: 0;
    }

    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3rem;
        align-items: center;
    }
    
    @media (max-width: 768px) {
        .contact-grid { grid-template-columns: 1fr; }
        .about-title { font-size: 2.5rem; }
        .about-section { padding: 2rem; }
    }
    
    .contact-info {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }
    
    .contact-item {
        display: flex;
        gap: 1rem;
        align-items: flex-start;
    }
    
    .contact-icon {
        font-size: 1.5rem;
        color: var(--wood-mid);
    }
    
    .contact-detail {
        display: flex;
        flex-direction: column;
    }
    
    .contact-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: var(--text-muted);
        margin-bottom: 0.2rem;
    }
    
    .contact-value {
        font-size: 1.1rem;
        color: var(--text-primary);
        font-family: 'Playfair Display', serif;
    }
    
    .support-box {
        background: rgba(20,15,10,0.5);
        border: 1px dashed var(--border-strong);
        padding: 2rem;
        border-radius: var(--radius-card);
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    
    .qr-placeholder {
        width: 180px;
        height: 180px;
        background: #fff;
        padding: 10px;
        border-radius: 8px;
        margin: 1.5rem 0;
        box-shadow: 0 4px 15px rgba(0,0,0,0.5);
    }
</style>
@endpush

@section('content')
<main class="gallery-main" style="width: 100%; overflow-y: auto;">
    <div class="about-container">
        
        <div class="about-header">
            <h1 class="about-title">Nuestra Historia</h1>
            <p class="about-subtitle">Rescatando la memoria visual de una región inolvidable</p>
        </div>

        <div class="about-section">
            <h2 class="section-heading">El Proyecto</h2>
            <p class="about-text">
                La Fototeca Digital Ancashina nace de la profunda necesidad de preservar, catalogar y difundir
                el invaluable patrimonio fotográfico de la región Ancash. Antes de la era digital, miles de 
                imágenes languidecían en archivos polvorientos, álbumes familiares olvidados y colecciones 
                privadas inaccesibles.
            </p>
            <p class="about-text">
                Nuestro equipo de historiadores, archivistas y desarrolladores se unió con un propósito común: 
                crear un santuario virtual donde la memoria visual de nuestras provincias no solo se conserve, 
                sino que viva y respire para las futuras generaciones. Especialmente, custodiamos el recuerdo 
                de los pueblos que desaparecieron o cambiaron su fisonomía radicalmente tras el trágico 
                terremoto del 31 de mayo de 1970.
            </p>
        </div>

        <div class="about-section">
            <h2 class="section-heading">Misión y Visión</h2>
            <p class="about-text">
                <strong>Nuestra Misión:</strong> Democratizar el acceso a la historia visual de Ancash, ofreciendo 
                una plataforma de investigación y nostalgia de alta calidad, respetando siempre la autoría y el 
                contexto histórico de cada fotografía.
            </p>
            <p class="about-text">
                <strong>Nuestra Visión:</strong> Convertirnos en el archivo digital histórico más completo del centro 
                y norte del país, integrando a futuro fotografías de cada rincón de los Conchucos y el Callejón de Huaylas,
                permitiendo que la diáspora ancashina en todo el mundo pueda reconectar con sus raíces.
            </p>
        </div>

        <div class="about-section">
            <h2 class="section-heading">Contacto y Ayuda</h2>
            
            <div class="contact-grid">
                <div class="contact-info">
                    <p class="about-text" style="font-size: 0.95rem; margin-bottom: 2rem;">
                        ¿Tienes fotografías históricas de Ancash en casa? ¿Conoces la identidad de personas u 
                        obras en nuestro archivo de "Autores Anónimos"? Escríbenos, tu aporte puede ayudar
                        a completar el gran rompecabezas de nuestra historia.
                    </p>

                    <div class="contact-item">
                        <div class="contact-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></div>
                        <div class="contact-detail">
                            <span class="contact-label">Correo Electrónico</span>
                            <span class="contact-value">archivo@fototecancash.pe</span>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></div>
                        <div class="contact-detail">
                            <span class="contact-label">Ubicación Física</span>
                            <span class="contact-value">Jr. San Martín N° 450, Huaraz - Perú</span>
                        </div>
                    </div>
                </div>

                <div class="support-box">
                    <h3 style="font-family: 'Playfair Display', serif; color: var(--sepia-light); font-size: 1.5rem;">Apoya Nuestra Causa</h3>
                    <p style="font-size: 0.85rem; color: var(--text-muted); margin-top: 0.5rem; line-height: 1.5;">
                        Digitalizar negativos antiguos, mantener los servidores y restaurar imágenes tiene un costo. 
                        Ayúdanos con un aporte voluntario.
                    </p>
                    
                    <!-- Código QR Yape / Plin Dummy -->
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=YAPE-Dummy-Code-Fototeca" alt="QR Yape" class="qr-placeholder" loading="lazy">
                    
                    <span style="font-weight: bold; color: var(--wood-light); letter-spacing: 0.05em;">YAPE / PLIN</span>
                    <span style="font-size: 1.2rem; margin-top: 0.3rem;">999 888 777</span>
                    <span style="font-size: 0.7rem; color: var(--text-muted); margin-top: 0.2rem;">A nombre de: Fototeca Archivo</span>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection
