@php
    $isEdit    = $photo !== null;
    $defaultImageType = $isEdit ? ($photo->image_path ? 'file' : 'url') : 'url';
@endphp

<form method="POST" action="{{ $action }}" enctype="multipart/form-data"
      x-data="{
          imageType: '{{ old('image_type', $defaultImageType) }}',
          circa: {{ old('circa', $isEdit ? ($photo->circa ? 'true' : 'false') : 'false') }},
      }">
    @csrf
    @if($method !== 'POST') @method($method) @endif

    <div class="form-card">
        <div class="form-grid">

            {{-- TÍTULO --}}
            <div class="form-group full">
                <label>Título *</label>
                <input type="text" name="title" value="{{ old('title', $photo?->title) }}" required>
                @error('title')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            {{-- DESCRIPCIÓN --}}
            <div class="form-group full">
                <label>Descripción</label>
                <textarea name="description" rows="3">{{ old('description', $photo?->description) }}</textarea>
                @error('description')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-divider"></div>
            <div class="form-section-title">Fecha y clasificación</div>

            {{-- AÑO --}}
            <div class="form-group">
                <label>Año</label>
                <div style="display:flex; gap:0.5rem; align-items:center;">
                    <input type="number" name="year" value="{{ old('year', $photo?->year) }}"
                           min="1800" max="2100" style="flex:1;">
                    <div class="checkbox-row">
                        <input type="checkbox" id="circa" name="circa" value="1"
                               x-model="circa"
                               {{ old('circa', $isEdit && $photo->circa) ? 'checked' : '' }}>
                        <label for="circa">circa (ca.)</label>
                    </div>
                </div>
                @error('year')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            {{-- PERÍODO --}}
            <div class="form-group">
                <label>Período histórico</label>
                <select name="historical_period">
                    <option value="">— Sin período —</option>
                    @foreach($periods as $period)
                    <option value="{{ $period->value }}"
                        {{ old('historical_period', $photo?->historical_period?->value) === $period->value ? 'selected' : '' }}>
                        {{ $period->label() }}
                    </option>
                    @endforeach
                </select>
                @error('historical_period')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            {{-- UBICACIÓN --}}
            <div class="form-group">
                <label>Ubicación</label>
                <select name="location_id">
                    <option value="">— Sin ubicación —</option>
                    @foreach($locations as $loc)
                    <option value="{{ $loc->id }}"
                        {{ old('location_id', $photo?->location_id) == $loc->id ? 'selected' : '' }}>
                        {{ $loc->name }} ({{ $loc->type->value }})
                    </option>
                    @endforeach
                </select>
                @error('location_id')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            {{-- FORMATO ORIGINAL --}}
            <div class="form-group">
                <label>Formato original</label>
                <input type="text" name="original_format"
                       value="{{ old('original_format', $photo?->original_format) }}"
                       placeholder="Ej: Diapositiva, negativo, papel...">
            </div>

            {{-- ARCHIVO FUENTE --}}
            <div class="form-group">
                <label>Archivo fuente</label>
                <input type="text" name="source_archive"
                       value="{{ old('source_archive', $photo?->source_archive) }}">
            </div>

            {{-- REFERENCIA --}}
            <div class="form-group">
                <label>Referencia</label>
                <input type="text" name="source_reference"
                       value="{{ old('source_reference', $photo?->source_reference) }}">
            </div>

            <div class="form-divider"></div>
            <div class="form-section-title">Imagen</div>

            {{-- IMAGE TYPE TOGGLE --}}
            <div class="form-group full">
                <label>Tipo de imagen</label>
                <div style="display:flex; gap:0;">
                    <label style="text-transform:none; letter-spacing:normal; cursor:pointer;
                                  padding:0.55rem 1.2rem; border:1px solid rgba(58,49,41,0.2);
                                  font-size:0.82rem; font-weight:600;
                                  background: imageType === 'url' ? 'var(--acento)' : 'var(--bg-crema)';
                                  color: imageType === 'url' ? 'white' : 'var(--text-oscuro)';"
                           :style="imageType === 'url'
                               ? 'background:var(--acento); color:white; border-color:var(--acento);'
                               : 'background:var(--bg-crema); color:var(--text-oscuro);'">
                        <input type="radio" name="image_type" value="url"
                               x-model="imageType" style="display:none;">
                        URL externa
                    </label>
                    <label style="text-transform:none; letter-spacing:normal; cursor:pointer;
                                  padding:0.55rem 1.2rem; border:1px solid rgba(58,49,41,0.2);
                                  border-left:none; font-size:0.82rem; font-weight:600;"
                           :style="imageType === 'file'
                               ? 'background:var(--acento); color:white; border-color:var(--acento);'
                               : 'background:var(--bg-crema); color:var(--text-oscuro);'">
                        <input type="radio" name="image_type" value="file"
                               x-model="imageType" style="display:none;">
                        Subir archivo
                    </label>
                </div>
            </div>

            {{-- URL INPUT --}}
            <div class="form-group full" x-show="imageType === 'url'" x-cloak>
                <label>URL de la imagen</label>
                <input type="url" name="image_url"
                       value="{{ old('image_url', $photo?->image_url) }}"
                       placeholder="https://...">
                <span class="form-hint">Enlace directo a la imagen. Máx. 2048 caracteres.</span>
                @error('image_url')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            {{-- FILE INPUT --}}
            <div class="form-group full" x-show="imageType === 'file'" x-cloak>
                <label>Archivo de imagen</label>
                @if($isEdit && $photo->image_path)
                    <div style="margin-bottom:0.5rem;">
                        <img src="{{ asset('storage/'.$photo->image_path) }}" alt=""
                             style="height:80px; object-fit:cover; filter:sepia(0.2);">
                        <span class="form-hint" style="display:block; margin-top:0.3rem;">
                            Imagen actual. Sube un nuevo archivo para reemplazarla.
                        </span>
                    </div>
                @endif
                <input type="file" name="image_file" accept="image/*"
                       style="background:white; padding:0.4rem;">
                <span class="form-hint">JPG, PNG, WebP. Máximo 15 MB.</span>
                @error('image_file')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-divider"></div>
            <div class="form-section-title">Fotógrafos</div>

            {{-- PHOTOGRAPHERS --}}
            <div class="form-group full">
                <label>Fotógrafos asignados</label>
                @php
                    $assignedPhotographers = $isEdit
                        ? $photo->photographers->keyBy('id')
                        : collect();
                @endphp
                <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(220px,1fr)); gap:0.5rem; max-height:200px; overflow-y:auto; border:1px solid rgba(58,49,41,0.15); padding:0.8rem; background:var(--bg-crema);">
                    @foreach($photographers as $pg)
                    @php
                        $checked   = in_array($pg->id, old('photographers', $assignedPhotographers->keys()->toArray()));
                        $savedRole = $assignedPhotographers[$pg->id]?->pivot?->role ?? 'photographer';
                        $oldRole   = old("photographer_roles.{$pg->id}", $savedRole);
                    @endphp
                    <div style="display:flex; flex-direction:column; gap:0.3rem; padding:0.5rem; background:white; border:1px solid rgba(58,49,41,0.08);">
                        <div class="checkbox-row">
                            <input type="checkbox" id="pg_{{ $pg->id }}" name="photographers[]"
                                   value="{{ $pg->id }}" {{ $checked ? 'checked' : '' }}>
                            <label for="pg_{{ $pg->id }}" style="font-size:0.8rem;">{{ $pg->display_name }}</label>
                        </div>
                        <select name="photographer_roles[{{ $pg->id }}]"
                                style="font-size:0.72rem; padding:0.25rem 0.4rem;">
                            @foreach(['photographer'=>'Fotógrafo','editor'=>'Editor','archivist'=>'Archivista','unknown'=>'Desconocido'] as $val => $lab)
                            <option value="{{ $val }}" {{ $oldRole === $val ? 'selected' : '' }}>{{ $lab }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="form-divider"></div>
            <div class="form-section-title">Categorías</div>

            {{-- CATEGORIES --}}
            <div class="form-group full">
                @php
                    $assignedCats = $isEdit ? $photo->categories->pluck('id')->toArray() : [];
                    $selectedCats = old('categories', $assignedCats);
                @endphp
                <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(180px,1fr)); gap:0.4rem; max-height:160px; overflow-y:auto; border:1px solid rgba(58,49,41,0.15); padding:0.8rem; background:var(--bg-crema);">
                    @foreach($categories as $cat)
                    <div class="checkbox-row">
                        <input type="checkbox" id="cat_{{ $cat->id }}" name="categories[]"
                               value="{{ $cat->id }}" {{ in_array($cat->id, $selectedCats) ? 'checked' : '' }}>
                        <label for="cat_{{ $cat->id }}" style="font-size:0.8rem;">{{ $cat->name }}</label>
                    </div>
                    @foreach($cat->children as $child)
                    <div class="checkbox-row" style="padding-left:1rem;">
                        <input type="checkbox" id="cat_{{ $child->id }}" name="categories[]"
                               value="{{ $child->id }}" {{ in_array($child->id, $selectedCats) ? 'checked' : '' }}>
                        <label for="cat_{{ $child->id }}" style="font-size:0.75rem; color:#888;">↳ {{ $child->name }}</label>
                    </div>
                    @endforeach
                    @endforeach
                </div>
            </div>

            <div class="form-divider"></div>
            <div class="form-section-title">Etiquetas</div>

            {{-- TAGS --}}
            <div class="form-group full">
                @php
                    $assignedTags = $isEdit ? $photo->tags->pluck('id')->toArray() : [];
                    $selectedTags = old('tags', $assignedTags);
                @endphp
                <div style="display:flex; flex-wrap:wrap; gap:0.4rem; border:1px solid rgba(58,49,41,0.15); padding:0.8rem; background:var(--bg-crema); max-height:120px; overflow-y:auto;">
                    @foreach($tags as $tag)
                    <label style="display:flex; align-items:center; gap:0.3rem; padding:0.3rem 0.7rem; background:white; border:1px solid rgba(58,49,41,0.12); cursor:pointer; font-size:0.78rem; text-transform:none; letter-spacing:normal; color:var(--text-oscuro);">
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                               {{ in_array($tag->id, $selectedTags) ? 'checked' : '' }}>
                        {{ $tag->name }}
                    </label>
                    @endforeach
                </div>
            </div>

            <div class="form-divider"></div>
            <div class="form-section-title">Publicación</div>

            {{-- IS PUBLISHED --}}
            <div class="form-group full">
                <div class="checkbox-row">
                    <input type="checkbox" id="is_published" name="is_published" value="1"
                           {{ old('is_published', $isEdit ? $photo->is_published : true) ? 'checked' : '' }}>
                    <label for="is_published">Publicar en la galería pública</label>
                </div>
            </div>

        </div>{{-- /form-grid --}}

        <div style="margin-top:2rem; display:flex; gap:1rem;">
            <button type="submit" class="btn btn-primary">
                {{ $isEdit ? 'Guardar cambios' : 'Crear fotografía' }}
            </button>
            <a href="{{ route('admin.fotos.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </div>
</form>
