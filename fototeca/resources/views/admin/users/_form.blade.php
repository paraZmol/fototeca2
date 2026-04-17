@php $isEdit = $user !== null; @endphp

<form method="POST" action="{{ $action }}">
    @csrf
    @if($method !== 'POST') @method($method) @endif

    <div class="form-card" style="max-width:500px;">
        <div class="form-grid" style="grid-template-columns:1fr;">

            <div class="form-group">
                <label>Nombre completo *</label>
                <input type="text" name="name" value="{{ old('name', $user?->name) }}" required>
                @error('name')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label>Correo electrónico *</label>
                <input type="email" name="email" value="{{ old('email', $user?->email) }}" required>
                @error('email')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label>Rol *</label>
                <select name="role" required>
                    <option value="user"        {{ old('role', $user?->role) === 'user'        ? 'selected' : '' }}>Usuario</option>
                    <option value="admin"       {{ old('role', $user?->role) === 'admin'       ? 'selected' : '' }}>Administrador</option>
                    <option value="super_admin" {{ old('role', $user?->role) === 'super_admin' ? 'selected' : '' }}>Super Administrador</option>
                </select>
                @error('role')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label>
                    Contraseña *
                    @if($isEdit)
                        <span class="form-hint">(dejar vacío para no cambiar)</span>
                    @endif
                </label>
                <input type="password" name="password"
                       {{ $isEdit ? '' : 'required' }}
                       autocomplete="new-password">
                @error('password')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label>Confirmar contraseña</label>
                <input type="password" name="password_confirmation" autocomplete="new-password">
            </div>

        </div>

        <div style="margin-top:1.5rem; display:flex; gap:1rem;">
            <button type="submit" class="btn btn-primary">
                {{ $isEdit ? 'Guardar cambios' : 'Crear usuario' }}
            </button>
            <a href="{{ route('admin.usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </div>
</form>
