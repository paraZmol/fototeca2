@extends('admin.layouts.app')
@section('title', 'Nuevo usuario')

@section('content')
<div class="page-header">
    <div><h1>Nuevo usuario</h1></div>
    <a href="{{ route('admin.usuarios.index') }}" class="btn btn-secondary">← Volver</a>
</div>

@include('admin.users._form', ['method' => 'POST', 'action' => route('admin.usuarios.store'), 'user' => null])
@endsection
