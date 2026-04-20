@extends('admin.layouts.app')
@section('title', 'Nueva fotografía')

@section('content')
<div class="page-header">
    <div>
        <h1>Nueva fotografía</h1>
        <p>Agregar una nueva imagen al archivo</p>
    </div>
    <a href="{{ route('admin.fotos.index') }}" class="btn btn-secondary">← Volver</a>
</div>

@include('admin.photos._form', ['method' => 'POST', 'action' => route('admin.fotos.store'), 'photo' => null])
@endsection
