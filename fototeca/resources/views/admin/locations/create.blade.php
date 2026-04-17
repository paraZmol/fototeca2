@extends('admin.layouts.app')
@section('title', 'Nueva ubicación')

@section('content')
<div class="page-header">
    <div><h1>Nueva ubicación</h1></div>
    <a href="{{ route('admin.ubicaciones.index') }}" class="btn btn-secondary">← Volver</a>
</div>

@include('admin.locations._form', ['method' => 'POST', 'action' => route('admin.ubicaciones.store'), 'location' => null])
@endsection
