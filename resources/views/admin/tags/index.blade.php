@extends('admin.layouts.app')
@section('title', 'Etiquetas')

@section('content')
<div class="page-header">
    <div>
        <h1>Etiquetas</h1>
        <p>{{ $tags->total() }} registros en total</p>
    </div>
    <a href="{{ route('admin.etiquetas.create') }}" class="btn btn-primary">+ Nueva etiqueta</a>
</div>

<form method="GET" class="search-bar">
    <input type="text" name="q" value="{{ request('q') }}" placeholder="Buscar etiqueta...">
    <button type="submit" class="btn btn-secondary">Buscar</button>
    @if(request('q'))
        <a href="{{ route('admin.etiquetas.index') }}" class="btn btn-secondary">✕ Limpiar</a>
    @endif
</form>

<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Slug</th>
                <th>Fotos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tags as $tag)
            <tr>
                <td><strong>{{ $tag->name }}</strong></td>
                <td style="font-size:0.78rem; color:#888; font-family:monospace;">{{ $tag->slug }}</td>
                <td><span style="font-weight:700; color:var(--acento);">{{ $tag->photos_count }}</span></td>
                <td>
                    <div class="actions">
                        <a href="{{ route('admin.etiquetas.edit', $tag) }}" class="btn btn-secondary btn-sm">Editar</a>
                        <form method="POST" action="{{ route('admin.etiquetas.destroy', $tag) }}"
                              onsubmit="return confirm('¿Eliminar esta etiqueta?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align:center; color:#aaa; padding:3rem;">Sin etiquetas.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="pagination-wrap">
    {{ $tags->links() }}
</div>
@endsection
