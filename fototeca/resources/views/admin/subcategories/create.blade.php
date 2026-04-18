@extends('admin.layouts.app')
@section('title', 'Nueva subcategoría')

@section('content')
<div class="page-header">
    <div><h1>Nueva subcategoría</h1></div>
    <a href="{{ route('admin.subcategorias.index') }}" class="btn btn-secondary">← Volver</a>
</div>

@include('admin.subcategories._form', ['method' => 'POST', 'action' => route('admin.subcategorias.store'), 'subcategory' => null])
@endsection
