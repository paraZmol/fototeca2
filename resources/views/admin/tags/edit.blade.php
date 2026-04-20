@extends('admin.layouts.app')
@section('title', 'Editar etiqueta')

@section('content')
<div class="page-header">
    <div>
        <h1>Editar etiqueta</h1>
        <p>{{ $tag->name }}</p>
    </div>
    <a href="{{ route('admin.etiquetas.index') }}" class="btn btn-secondary">← Volver</a>
</div>

@include('admin.tags._form', [
    'method' => 'PUT',
    'action' => route('admin.etiquetas.update', $tag),
    'tag'    => $tag,
])
@endsection
