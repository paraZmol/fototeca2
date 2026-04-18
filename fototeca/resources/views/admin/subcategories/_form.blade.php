@php $isEdit = $subcategory !== null; @endphp

<form method="POST" action="{{ $action }}">
    @csrf
    @if($method !== 'POST') @method($method) @endif

    <div class="form-card" style="max-width:500px;">
        <div class="form-grid" style="grid-template-columns:1fr;">

            <div class="form-group">
                <label>Nombre *</label>
                <input type="text" name="name" value="{{ old('name', $subcategory?->name) }}" required>
                @error('name')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label>Slug <span class="form-hint">(se genera automáticamente si se deja vacío)</span></label>
                <input type="text" name="slug" value="{{ old('slug', $subcategory?->slug) }}"
                       placeholder="mi-subcategoria">
                @error('slug')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label>Icono <span class="form-hint">(emoji o símbolo)</span></label>
                <input type="text" name="icon" value="{{ old('icon', $subcategory?->icon) }}"
                       placeholder="📷" maxlength="10">
                @error('icon')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label>Categoría *</label>
                <select name="category_id" required>
                    <option value="">— Seleccionar categoría —</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}"
                        {{ old('category_id', $subcategory?->category_id) == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}{{ $cat->location ? ' (' . $cat->location->name . ')' : '' }}
                    </option>
                    @endforeach
                </select>
                @error('category_id')<span class="field-error">{{ $message }}</span>@enderror
            </div>

        </div>

        <div style="margin-top:1.5rem; display:flex; gap:1rem;">
            <button type="submit" class="btn btn-primary">
                {{ $isEdit ? 'Guardar cambios' : 'Crear subcategoría' }}
            </button>
            <a href="{{ route('admin.subcategorias.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </div>
</form>
