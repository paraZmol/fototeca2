@extends('admin.layouts.app')
@section('title', 'Usuarios')

@section('content')
<div class="page-header">
    <div>
        <h1>Usuarios</h1>
        <p>{{ $users->total() }} registros en total</p>
    </div>
    <a href="{{ route('admin.usuarios.create') }}" class="btn btn-primary">+ Nuevo usuario</a>
</div>

<form method="GET" class="search-bar">
    <input type="text" name="q" value="{{ request('q') }}" placeholder="Buscar por nombre o correo...">
    <button type="submit" class="btn btn-secondary">Buscar</button>
    @if(request('q'))
        <a href="{{ route('admin.usuarios.index') }}" class="btn btn-secondary">✕ Limpiar</a>
    @endif
</form>

<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo electrónico</th>
                <th>Rol</th>
                <th>Registrado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td>
                    <strong>{{ $user->name }}</strong>
                    @if($user->id === auth()->id())
                        <span class="badge badge-published" style="margin-left:0.4rem;">Tú</span>
                    @endif
                </td>
                <td style="font-size:0.85rem;">{{ $user->email }}</td>
                <td>
                    @if($user->role === 'super_admin')
                        <span class="badge badge-super">Super Admin</span>
                    @elseif($user->role === 'admin')
                        <span class="badge badge-admin">Admin</span>
                    @else
                        <span class="badge badge-user">Usuario</span>
                    @endif
                </td>
                <td style="font-size:0.78rem; color:#888; white-space:nowrap;">
                    {{ $user->created_at->format('d/m/Y') }}
                </td>
                <td>
                    <div class="actions">
                        <a href="{{ route('admin.usuarios.edit', $user) }}" class="btn btn-secondary btn-sm">Editar</a>
                        @if(!$user->isSuperAdmin())
                        <form method="POST" action="{{ route('admin.usuarios.destroy', $user) }}"
                              onsubmit="return confirm('¿Eliminar este usuario?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center; color:#aaa; padding:3rem;">Sin usuarios.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="pagination-wrap">
    {{ $users->links() }}
</div>
@endsection
