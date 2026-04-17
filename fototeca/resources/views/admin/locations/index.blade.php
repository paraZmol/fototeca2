@extends('admin.layouts.app')
@section('title', 'Ubicaciones')

@section('content')
<div class="page-header">
    <div>
        <h1>Ubicaciones</h1>
        <p>{{ $locations->total() }} registros en total</p>
    </div>
    <a href="{{ route('admin.ubicaciones.create') }}" class="btn btn-primary">+ Nueva ubicación</a>
</div>

@php
$typeLabels = [
    'region'       => 'Región',
    'province'     => 'Provincia',
    'district'     => 'Distrito',
    'neighborhood' => 'Barrio',
    'place'        => 'Lugar',
];
@endphp

<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Pertenece a</th>
                <th>Fotos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($locations as $loc)
            <tr>
                <td><strong>{{ $loc->name }}</strong></td>
                <td>
                    <span class="badge badge-draft">{{ $typeLabels[$loc->type->value] ?? $loc->type->value }}</span>
                </td>
                <td style="font-size:0.82rem; color:#888;">{{ $loc->parent?->name ?? '—' }}</td>
                <td><span style="font-weight:700; color:var(--acento);">{{ $loc->photos_count }}</span></td>
                <td>
                    <div class="actions">
                        <a href="{{ route('admin.ubicaciones.edit', $loc) }}" class="btn btn-secondary btn-sm">Editar</a>
                        <form method="POST" action="{{ route('admin.ubicaciones.destroy', $loc) }}"
                              onsubmit="return confirm('¿Eliminar esta ubicación?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center; color:#aaa; padding:3rem;">Sin ubicaciones.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="pagination-wrap">
    {{ $locations->links() }}
</div>
@endsection
