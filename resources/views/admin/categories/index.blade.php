@extends('admin.layouts.app')
@section('title', 'Categorías')

@section('content')
<div class="page-header">
    <div>
        <h1>Categorías</h1>
        <p>{{ $categories->total() }} registros en total</p>
    </div>
    <a href="{{ route('admin.categorias.create') }}" class="btn btn-primary">+ Nueva categoría</a>
</div>

<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Slug</th>
                <th>Categoría padre</th>
                <th>Icono</th>
                <th>Fotos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $cat)
            <tr>
                <td><strong>{{ $cat->name }}</strong></td>
                <td style="font-size:0.78rem; color:#888; font-family:monospace;">{{ $cat->slug }}</td>
                <td style="font-size:0.82rem; color:#888;">{{ $cat->parent?->name ?? '—' }}</td>
                <td style="font-size:1.1rem;">{{ $cat->icon ?? '—' }}</td>
                <td><span style="font-weight:700; color:var(--acento);">{{ $cat->photos_count }}</span></td>
                <td>
                    <div class="actions">
                        <a href="{{ route('admin.categorias.edit', $cat) }}" class="btn btn-secondary btn-sm">Editar</a>
                        <form method="POST" action="{{ route('admin.categorias.destroy', $cat) }}"
                              onsubmit="return confirm('¿Eliminar esta categoría?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center; color:#aaa; padding:3rem;">Sin categorías.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="pagination-wrap">
    {{ $categories->links() }}
</div>
@endsection
