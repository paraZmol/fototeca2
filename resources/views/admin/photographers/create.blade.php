@extends('admin.layouts.app')
@section('title', 'Nuevo fotógrafo')

@section('content')
<div class="page-header">
    <div>
        <h1>Nuevo fotógrafo</h1>
    </div>
    <a href="{{ route('admin.fotografos.index') }}" class="btn btn-secondary">← Volver</a>
</div>

@include('admin.photographers._form', ['method' => 'POST', 'action' => route('admin.fotografos.store'), 'photographer' => null])
@endsection
