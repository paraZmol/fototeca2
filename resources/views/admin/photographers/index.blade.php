@extends('admin.layouts.app')
@section('title', 'Fotógrafos')

@section('content')
<div class="page-header">
    <div>
        <h1>Fotógrafos</h1>
        <p>{{ $photographers->total() }} registros en total</p>
    </div>
    <a href="{{ route('admin.fotografos.create') }}" class="btn btn-primary">+ Nuevo fotógrafo</a>
</div>

<form method="GET" class="search-bar">
    <input type="text" name="q" value="{{ request('q') }}" placeholder="Buscar por nombre o seudónimo...">
    <button type="submit" class="btn btn-secondary">Buscar</button>
    @if(request('q'))
        <a href="{{ route('admin.fotografos.index') }}" class="btn btn-secondary">✕ Limpiar</a>
    @endif
</form>

<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Seudónimo</th>
                <th>Nacionalidad</th>
                <th>Años</th>
                <th>Fotos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($photographers as $pg)
            <tr>
                <td>
                    <strong>{{ $pg->name }}</strong>
                    @if($pg->is_anonymous)
                        <span class="badge badge-draft" style="margin-left:0.4rem;">anónimo</span>
                    @endif
                </td>
                <td style="color:#888; font-size:0.82rem;">{{ $pg->pseudonym ?? '—' }}</td>
                <td style="font-size:0.82rem;">{{ $pg->nationality ?? '—' }}</td>
                <td style="font-size:0.82rem; white-space:nowrap;">{{ $pg->lifespan ?? '—' }}</td>
                <td>
                    <span style="font-weight:700; color:var(--acento);">{{ $pg->photos_count }}</span>
                </td>
                <td>
                    <div class="actions">
                        <a href="{{ route('admin.fotografos.edit', $pg) }}" class="btn btn-secondary btn-sm">Editar</a>
                        <form method="POST" action="{{ route('admin.fotografos.destroy', $pg) }}"
                              onsubmit="return confirm('¿Eliminar este fotógrafo?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center; color:#aaa; padding:3rem;">
                    No hay fotógrafos registrados.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="pagination-wrap">
    {{ $photographers->links() }}
</div>
@endsection
