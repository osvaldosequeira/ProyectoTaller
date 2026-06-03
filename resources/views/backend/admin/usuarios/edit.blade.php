<div class="mb-3">
    <label class="form-label text-warning small fw-bold text-uppercase">Rol del Usuario</label>
    <select name="es_admin" class="form-select bg-dark text-white border-secondary">
        <option value="0" {{ $usuario->es_admin == 0 ? 'selected' : '' }}>Cliente</option>
        <option value="1" {{ $usuario->es_admin == 1 ? 'selected' : '' }}>Administrador</option>
    </select>
</div>