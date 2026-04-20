@extends('admin.layouts.app')
@section('title', 'Editar ubicación')

@section('content')
<div class="page-header">
    <div>
        <h1>Editar ubicación</h1>
        <p>{{ $location->name }}</p>
    </div>
    <a href="{{ route('admin.ubicaciones.index') }}" class="btn btn-secondary">← Volver</a>
</div>

@include('admin.locations._form', [
    'method'   => 'PUT',
    'action'   => route('admin.ubicaciones.update', $location),
    'location' => $location,
])
@endsection
