@extends('admin.layouts.app')
@section('title', 'Subcategorías')

@section('content')
<div class="page-header">
    <div>
        <h1>Subcategorías</h1>
        <p>{{ $subcategories->total() }} registros en total</p>
    </div>
    <a href="{{ route('admin.subcategorias.create') }}" class="btn btn-primary">+ Nueva subcategoría</a>
</div>

<div class="search-bar">
    <form method="GET" action="{{ route('admin.subcategorias.index') }}" style="display:flex; gap:0.5rem;">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Buscar subcategoría...">
        <button type="submit" class="btn btn-secondary btn-sm">Buscar</button>
    </form>
</div>

<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Slug</th>
                <th>Categoría</th>
                <th>Ubicación</th>
                <th>Icono</th>
                <th>Fotos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($subcategories as $sub)
            <tr>
                <td><strong>{{ $sub->name }}</strong></td>
                <td style="font-size:0.78rem; color:#888; font-family:monospace;">{{ $sub->slug }}</td>
                <td style="font-size:0.82rem; color:#888;">{{ $sub->category->name }}</td>
                <td style="font-size:0.82rem; color:#888;">{{ $sub->category->location?->name ?? '—' }}</td>
                <td style="font-size:1.1rem;">{{ $sub->icon ?? '—' }}</td>
                <td><span style="font-weight:700; color:var(--acento);">{{ $sub->photos_count }}</span></td>
                <td>
                    <div class="actions">
                        <a href="{{ route('admin.subcategorias.edit', $sub) }}" class="btn btn-secondary btn-sm">Editar</a>
                        <form method="POST" action="{{ route('admin.subcategorias.destroy', $sub) }}"
                              onsubmit="return confirm('¿Eliminar esta subcategoría?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align:center; color:#aaa; padding:3rem;">Sin subcategorías.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="pagination-wrap">
    {{ $subcategories->links() }}
</div>
@endsection
