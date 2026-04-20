@extends('admin.layouts.app')
@section('title', 'Editar subcategoría')

@section('content')
<div class="page-header">
    <div>
        <h1>Editar subcategoría</h1>
        <p>{{ $subcategory->name }}</p>
    </div>
    <a href="{{ route('admin.subcategorias.index') }}" class="btn btn-secondary">← Volver</a>
</div>

@include('admin.subcategories._form', [
    'method'      => 'PUT',
    'action'      => route('admin.subcategorias.update', $subcategory),
    'subcategory' => $subcategory,
])
@endsection
