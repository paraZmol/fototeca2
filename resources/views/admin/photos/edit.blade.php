@extends('admin.layouts.app')
@section('title', 'Editar fotografía')

@section('content')
<div class="page-header">
    <div>
        <h1>Editar fotografía</h1>
        <p>{{ $photo->title }}</p>
    </div>
    <a href="{{ route('admin.fotos.index') }}" class="btn btn-secondary">← Volver</a>
</div>

@include('admin.photos._form', [
    'method' => 'PUT',
    'action' => route('admin.fotos.update', $photo),
    'photo'  => $photo,
])
@endsection
