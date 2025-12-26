<div class="mb-3">
    <label class="form-label">Kode Kendaraan</label>
    <input type="text" name="kode_kendaraan" class="form-control" value="{{ $vehicle->kode_kendaraan ?? '' }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Merk</label>
    <input type="text" name="merk" class="form-control" value="{{ $vehicle->merk ?? '' }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Nomor Polisi</label>
    <input type="text" name="nomor_polisi" class="form-control" value="{{ $vehicle->nomor_polisi ?? '' }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Jenis</label>
    <select name="jenis" class="form-select">
        <option value="angkutan_orang" {{ ($vehicle->jenis ?? '') == 'angkutan_orang' ? 'selected' : '' }}>
            Angkutan Orang
        </option>
        <option value="angkutan_barang" {{ ($vehicle->jenis ?? '') == 'angkutan_barang' ? 'selected' : '' }}>
            Angkutan Barang
        </option>
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Status</label>
    <select name="status" class="form-select">
        <option value="tersedia" {{ ($vehicle->status ?? '') == 'tersedia' ? 'selected' : '' }}>
            Tersedia
        </option>
        <option value="dipakai" {{ ($vehicle->status ?? '') == 'dipakai' ? 'selected' : '' }}>
            Dipakai
        </option>
        <option value="service" {{ ($vehicle->status ?? '') == 'service' ? 'selected' : '' }}>
            Service
        </option>
    </select>
</div>