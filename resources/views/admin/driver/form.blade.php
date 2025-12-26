<div class="mb-3">
    <label class="form-label">Nama Driver</label>
    <input type="text" name="nama" class="form-control" value="{{ $driver->nama ?? '' }}" required>
</div>

<div class="mb-3">
    <label class="form-label">No HP</label>
    <input type="text" name="no_hp" class="form-control" value="{{ $driver->no_hp ?? '' }}">
</div>

<div class="mb-3">
    <label class="form-label">Status</label>
    <select name="status" class="form-select" required>
        <option value="aktif" {{ ($driver->status ?? '') == 'aktif' ? 'selected' : '' }}>
            Aktif
        </option>
        <option value="tidak tersedia" {{ ($driver->status ?? '') == 'tidak tersedia' ? 'selected' : '' }}>
            Tidak Tersedia
        </option>
    </select>
</div>