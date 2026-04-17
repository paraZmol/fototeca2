@php $isEdit = $category !== null; @endphp

<form method="POST" action="{{ $action }}">
    @csrf
    @if($method !== 'POST') @method($method) @endif

    <div class="form-card" style="max-width:500px;">
        <div class="form-grid" style="grid-template-columns:1fr;">

            <div class="form-group">
                <label>Nombre *</label>
                <input type="text" name="name" value="{{ old('name', $category?->name) }}" required>
                @error('name')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label>Slug <span class="form-hint">(se genera automáticamente si se deja vacío)</span></label>
                <input type="text" name="slug" value="{{ old('slug', $category?->slug) }}"
                       placeholder="mi-categoria">
                @error('slug')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label>Icono <span class="form-hint">(emoji o símbolo)</span></label>
                <input type="text" name="icon" value="{{ old('icon', $category?->icon) }}"
                       placeholder="📷" maxlength="10">
                @error('icon')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label>Categoría padre</label>
                <select name="parent_id">
                    <option value="">— Ninguna (categoría raíz) —</option>
                    @foreach($parents as $parent)
                    <option value="{{ $parent->id }}"
                        {{ old('parent_id', $category?->parent_id) == $parent->id ? 'selected' : '' }}>
                        {{ $parent->name }}
                    </option>
                    @endforeach
                </select>
                @error('parent_id')<span class="field-error">{{ $message }}</span>@enderror
            </div>

        </div>

        <div style="margin-top:1.5rem; display:flex; gap:1rem;">
            <button type="submit" class="btn btn-primary">
                {{ $isEdit ? 'Guardar cambios' : 'Crear categoría' }}
            </button>
            <a href="{{ route('admin.categorias.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </div>
</form>
