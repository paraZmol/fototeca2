@php $isEdit = $photographer !== null; @endphp

<form method="POST" action="{{ $action }}" enctype="multipart/form-data">
    @csrf
    @if($method !== 'POST') @method($method) @endif

    <div class="form-card">
        <div class="form-grid">

            <div class="form-group">
                <label>Nombre completo *</label>
                <input type="text" name="name" value="{{ old('name', $photographer?->name) }}" required>
                @error('name')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label>Seudónimo</label>
                <input type="text" name="pseudonym" value="{{ old('pseudonym', $photographer?->pseudonym) }}">
                @error('pseudonym')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label>Año de nacimiento</label>
                <input type="number" name="birth_year" value="{{ old('birth_year', $photographer?->birth_year) }}"
                       min="1800" max="2100">
                @error('birth_year')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label>Año de fallecimiento</label>
                <input type="number" name="death_year" value="{{ old('death_year', $photographer?->death_year) }}"
                       min="1800" max="2100">
                @error('death_year')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label>Nacionalidad</label>
                <input type="text" name="nationality" value="{{ old('nationality', $photographer?->nationality) }}">
                @error('nationality')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label>Retrato</label>
                @if($isEdit && $photographer->portrait_path)
                    <div style="margin-bottom:0.5rem;">
                        <img src="{{ asset('storage/'.$photographer->portrait_path) }}" alt=""
                             style="height:60px; width:60px; object-fit:cover; filter:sepia(0.2);">
                    </div>
                @endif
                <input type="file" name="portrait" accept="image/*" style="background:white; padding:0.4rem;">
                <span class="form-hint">JPG, PNG. Máximo 15 MB.</span>
                @error('portrait')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group full">
                <label>Biografía</label>
                <textarea name="biography" rows="4">{{ old('biography', $photographer?->biography) }}</textarea>
                @error('biography')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group full">
                <div class="checkbox-row">
                    <input type="checkbox" id="is_anonymous" name="is_anonymous" value="1"
                           {{ old('is_anonymous', $isEdit && $photographer->is_anonymous) ? 'checked' : '' }}>
                    <label for="is_anonymous">Autor anónimo / desconocido</label>
                </div>
            </div>

        </div>

        <div style="margin-top:2rem; display:flex; gap:1rem;">
            <button type="submit" class="btn btn-primary">
                {{ $isEdit ? 'Guardar cambios' : 'Crear fotógrafo' }}
            </button>
            <a href="{{ route('admin.fotografos.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </div>
</form>
