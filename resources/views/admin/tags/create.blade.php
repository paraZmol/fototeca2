@extends('admin.layouts.app')
@section('title', 'Nueva etiqueta')

@section('content')
<div class="page-header">
    <div><h1>Nueva etiqueta</h1></div>
    <a href="{{ route('admin.etiquetas.index') }}" class="btn btn-secondary">← Volver</a>
</div>

@include('admin.tags._form', ['method' => 'POST', 'action' => route('admin.etiquetas.store'), 'tag' => null])
@endsection
