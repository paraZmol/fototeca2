@extends('admin.layouts.app')
@section('title', 'Editar fotógrafo')

@section('content')
<div class="page-header">
    <div>
        <h1>Editar fotógrafo</h1>
        <p>{{ $photographer->name }}</p>
    </div>
    <a href="{{ route('admin.fotografos.index') }}" class="btn btn-secondary">← Volver</a>
</div>

@include('admin.photographers._form', [
    'method'       => 'PUT',
    'action'       => route('admin.fotografos.update', $photographer),
    'photographer' => $photographer,
])
@endsection
