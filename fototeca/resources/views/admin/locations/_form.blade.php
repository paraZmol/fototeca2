@php $isEdit = $location !== null; @endphp

<form method="POST" action="{{ $action }}">
    @csrf
    @if($method !== 'POST') @method($method) @endif

    <div class="form-card" style="max-width:500px;">
        <div class="form-grid" style="grid-template-columns:1fr;">

            <div class="form-group">
                <label>Nombre *</label>
                <input type="text" name="name" value="{{ old('name', $location?->name) }}" required>
                @error('name')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label>Tipo *</label>
                <select name="type" required>
                    @foreach($types as $type)
                    <option value="{{ $type->value }}"
                        {{ old('type', $location?->type?->value) === $type->value ? 'selected' : '' }}>
                        {{ ucfirst($type->value) }}
                    </option>
                    @endforeach
                </select>
                @error('type')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label>Ubicación padre</label>
                <select name="parent_id">
                    <option value="">— Ninguna (nivel raíz) —</option>
                    @foreach($parents as $parent)
                    <option value="{{ $parent->id }}"
                        {{ old('parent_id', $location?->parent_id) == $parent->id ? 'selected' : '' }}>
                        {{ $parent->name }} ({{ $parent->type->value }})
                    </option>
                    @endforeach
                </select>
                @error('parent_id')<span class="field-error">{{ $message }}</span>@enderror
            </div>

        </div>

        <div style="margin-top:1.5rem; display:flex; gap:1rem;">
            <button type="submit" class="btn btn-primary">
                {{ $isEdit ? 'Guardar cambios' : 'Crear ubicación' }}
            </button>
            <a href="{{ route('admin.ubicaciones.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </div>
</form>
