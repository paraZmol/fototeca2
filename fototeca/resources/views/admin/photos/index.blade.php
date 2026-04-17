@extends('admin.layouts.app')
@section('title', 'Fotografías')

@section('content')
<div class="page-header">
    <div>
        <h1>Fotografías</h1>
        <p>{{ $photos->total() }} registros en total</p>
    </div>
    <a href="{{ route('admin.fotos.create') }}" class="btn btn-primary">+ Nueva fotografía</a>
</div>

<form method="GET" class="search-bar">
    <input type="text" name="q" value="{{ request('q') }}" placeholder="Buscar por título o descripción...">
    <button type="submit" class="btn btn-secondary">Buscar</button>
    @if(request('q'))
        <a href="{{ route('admin.fotos.index') }}" class="btn btn-secondary">✕ Limpiar</a>
    @endif
</form>

<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Título</th>
                <th>Año</th>
                <th>Período</th>
                <th>Ubicación</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($photos as $photo)
            <tr>
                <td><img src="{{ $photo->image_src }}" alt="" class="thumb"></td>
                <td style="max-width:220px;">
                    <strong>{{ $photo->title }}</strong>
                </td>
                <td style="white-space:nowrap;">{{ $photo->year_label }}</td>
                <td style="white-space:nowrap; font-size:0.78rem; color:#888;">
                    {{ $photo->historical_period?->label() ?? '—' }}
                </td>
                <td style="font-size:0.78rem; color:#888;">
                    {{ $photo->location?->name ?? '—' }}
                </td>
                <td>
                    <span class="badge {{ $photo->is_published ? 'badge-published' : 'badge-draft' }}">
                        {{ $photo->is_published ? 'Publicada' : 'Borrador' }}
                    </span>
                </td>
                <td>
                    <div class="actions">
                        <a href="{{ route('admin.fotos.edit', $photo) }}" class="btn btn-secondary btn-sm">Editar</a>
                        <form method="POST" action="{{ route('admin.fotos.destroy', $photo) }}"
                              onsubmit="return confirm('¿Eliminar esta fotografía?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align:center; color:#aaa; padding:3rem;">
                    No hay fotografías{{ request('q') ? ' con ese criterio' : '' }}.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="pagination-wrap">
    {{ $photos->links() }}
</div>
@endsection
