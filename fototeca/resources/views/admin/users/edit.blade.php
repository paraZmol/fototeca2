@extends('admin.layouts.app')
@section('title', 'Editar usuario')

@section('content')
<div class="page-header">
    <div>
        <h1>Editar usuario</h1>
        <p>{{ $user->name }}</p>
    </div>
    <a href="{{ route('admin.usuarios.index') }}" class="btn btn-secondary">← Volver</a>
</div>

@include('admin.users._form', [
    'method' => 'PUT',
    'action' => route('admin.usuarios.update', $user),
    'user'   => $user,
])
@endsection
