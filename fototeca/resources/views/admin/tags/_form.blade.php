@php $isEdit = $tag !== null; @endphp

<form method="POST" action="{{ $action }}">
    @csrf
    @if($method !== 'POST') @method($method) @endif

    <div class="form-card" style="max-width:400px;">
        <div class="form-grid" style="grid-template-columns:1fr;">

            <div class="form-group">
                <label>Nombre *</label>
                <input type="text" name="name" value="{{ old('name', $tag?->name) }}" required>
                @error('name')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label>Slug <span class="form-hint">(opcional, se genera automáticamente)</span></label>
                <input type="text" name="slug" value="{{ old('slug', $tag?->slug) }}"
                       placeholder="mi-etiqueta">
                @error('slug')<span class="field-error">{{ $message }}</span>@enderror
            </div>

        </div>

        <div style="margin-top:1.5rem; display:flex; gap:1rem;">
            <button type="submit" class="btn btn-primary">
                {{ $isEdit ? 'Guardar cambios' : 'Crear etiqueta' }}
            </button>
            <a href="{{ route('admin.etiquetas.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </div>
</form>
