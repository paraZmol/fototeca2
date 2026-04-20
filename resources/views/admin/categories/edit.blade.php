@extends('admin.layouts.app')
@section('title', 'Editar categoría')

@section('content')
<div class="page-header">
    <div>
        <h1>Editar categoría</h1>
        <p>{{ $category->name }}</p>
    </div>
    <a href="{{ route('admin.categorias.index') }}" class="btn btn-secondary">← Volver</a>
</div>

@include('admin.categories._form', [
    'method'   => 'PUT',
    'action'   => route('admin.categorias.update', $category),
    'category' => $category,
])
@endsection
