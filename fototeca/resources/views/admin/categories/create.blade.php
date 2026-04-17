@extends('admin.layouts.app')
@section('title', 'Nueva categoría')

@section('content')
<div class="page-header">
    <div><h1>Nueva categoría</h1></div>
    <a href="{{ route('admin.categorias.index') }}" class="btn btn-secondary">← Volver</a>
</div>

@include('admin.categories._form', ['method' => 'POST', 'action' => route('admin.categorias.store'), 'category' => null])
@endsection
