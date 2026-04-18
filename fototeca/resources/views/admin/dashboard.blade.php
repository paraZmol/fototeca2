@extends('admin.layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="page-header">
    <div>
        <h1>Dashboard</h1>
        <p>Resumen del archivo fotográfico</p>
    </div>
    <a href="{{ route('admin.fotos.create') }}" class="btn btn-primary">+ Nueva fotografía</a>
</div>

<div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(160px,1fr)); gap:1rem; margin-bottom:2.5rem;">
    @php
    $cards = [
        ['label'=>'Fotografías','value'=>$stats['photos'],'sub'=>$stats['published'].' publicadas','color'=>'#5c6bc0','route'=>'admin.fotos.index'],
        ['label'=>'Fotógrafos','value'=>$stats['photographers'],'sub'=>'en la colección','color'=>'#c8a96e','route'=>'admin.fotografos.index'],
        ['label'=>'Categorías','value'=>$stats['categories'],'sub'=>'temáticas','color'=>'#2b2f35','route'=>'admin.categorias.index'],
        ['label'=>'Subcategorías','value'=>$stats['subcategories'],'sub'=>'específicas','color'=>'#5c6bc0','route'=>'admin.subcategorias.index'],
        ['label'=>'Ubicaciones','value'=>$stats['locations'],'sub'=>'geográficas','color'=>'#c8a96e','route'=>'admin.ubicaciones.index'],
        ['label'=>'Etiquetas','value'=>$stats['tags'],'sub'=>'palabras clave','color'=>'#2b2f35','route'=>'admin.etiquetas.index'],
        ['label'=>'Usuarios','value'=>$stats['users'],'sub'=>'registrados','color'=>'#5c6bc0','route'=>auth()->user()->isSuperAdmin() ? 'admin.usuarios.index' : null],
    ];
    @endphp

    @foreach($cards as $card)
    <a href="{{ $card['route'] ? route($card['route']) : '#' }}"
       style="background:white; border:1px solid rgba(58,49,41,0.1); padding:1.4rem 1.2rem; text-decoration:none; display:block; border-top:3px solid {{ $card['color'] }}; transition:box-shadow 0.2s;"
       onmouseover="this.style.boxShadow='0 4px 16px rgba(0,0,0,0.08)'"
       onmouseout="this.style.boxShadow='none'">
        <div style="font-family:'Playfair Display',serif; font-size:2.2rem; font-weight:700; color:{{ $card['color'] }}; line-height:1;">
            {{ number_format($card['value']) }}
        </div>
        <div style="font-size:0.7rem; font-weight:700; letter-spacing:0.2em; text-transform:uppercase; color:#888; margin-top:0.4rem;">
            {{ $card['label'] }}
        </div>
        <div style="font-size:0.72rem; color:#aaa; margin-top:0.2rem;">{{ $card['sub'] }}</div>
    </a>
    @endforeach
</div>

<div style="display:grid; grid-template-columns:2fr 1fr; gap:1.5rem; align-items:start;">
    <!-- Recent photos -->
    <div>
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
            <h2 style="font-family:'Playfair Display',serif; font-size:1.1rem; font-weight:700; color:var(--text-oscuro);">Fotografías recientes</h2>
            <a href="{{ route('admin.fotos.index') }}" style="font-size:0.72rem; color:var(--acento); text-decoration:none; font-weight:700; letter-spacing:0.1em;">Ver todas →</a>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Título</th>
                        <th>Año</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentPhotos as $photo)
                    <tr>
                        <td>
                            <img src="{{ $photo->image_src }}" alt="" class="thumb">
                        </td>
                        <td style="max-width:200px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                            {{ $photo->title }}
                        </td>
                        <td>{{ $photo->year_label }}</td>
                        <td>
                            <span class="badge {{ $photo->is_published ? 'badge-published' : 'badge-draft' }}">
                                {{ $photo->is_published ? 'Publicada' : 'Borrador' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.fotos.edit', $photo) }}" class="btn btn-secondary btn-sm">Editar</a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" style="text-align:center; color:#aaa; padding:2rem;">Sin fotografías aún.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Quick links -->
    <div>
        <div style="margin-bottom:1rem;">
            <h2 style="font-family:'Playfair Display',serif; font-size:1.1rem; font-weight:700; color:var(--text-oscuro);">Acceso rápido</h2>
        </div>
        <div style="background:white; border:1px solid rgba(58,49,41,0.1); padding:1.2rem; display:flex; flex-direction:column; gap:0.6rem;">
            <a href="{{ route('admin.fotos.create') }}" class="btn btn-primary" style="text-align:center;">+ Nueva fotografía</a>
            <a href="{{ route('admin.fotografos.create') }}" class="btn btn-secondary" style="text-align:center;">+ Nuevo fotógrafo</a>
            <a href="{{ route('admin.categorias.create') }}" class="btn btn-secondary" style="text-align:center;">+ Nueva categoría</a>
            <a href="{{ route('admin.subcategorias.create') }}" class="btn btn-secondary" style="text-align:center;">+ Nueva subcategoría</a>
            <a href="{{ route('admin.etiquetas.create') }}" class="btn btn-secondary" style="text-align:center;">+ Nueva etiqueta</a>
            <a href="{{ route('admin.ubicaciones.create') }}" class="btn btn-secondary" style="text-align:center;">+ Nueva ubicación</a>
            @if(auth()->user()->isSuperAdmin())
            <a href="{{ route('admin.usuarios.create') }}" class="btn btn-secondary" style="text-align:center;">+ Nuevo usuario</a>
            @endif
        </div>
    </div>
</div>
@endsection
