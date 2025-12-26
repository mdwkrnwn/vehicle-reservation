@extends('admin.layout.app')

@section('content')
    <div class="container-xl px-4">
        <div class="card mt-4">
            <div class="card-header">Tambah Pemesanan Kendaraan</div>

            <div class="card-body">
                <form action="{{ route('admin.vehicle-booking.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Kendaraan</label>
                        <select name="vehicle_id" class="form-select" required>
                            <option value="">-- Pilih Kendaraan --</option>
                            @foreach($vehicles as $v)
                                <option value="{{ $v->id }}">
                                    {{ $v->kode_kendaraan }} - {{ $v->merk }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Keperluan</label>
                        <textarea name="keperluan" class="form-control" required></textarea>
                    </div>

                    <hr>

                    <div class="mb-3">
                        <label class="form-label">Driver</label>
                        <select name="driver_id" class="form-select" required>
                            <option value="">-- Pilih Driver --</option>
                            @foreach($drivers as $d)
                                <option value="{{ $d->id }}">
                                    {{ $d->nama }} ({{ $d->no_hp }})
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Approver Level 1</label>
                        <select name="approver_1" class="form-select" required>
                            <option value="">-- Pilih Approver Level 1 --</option>
                            @foreach($approverLevel1 as $a)
                                <option value="{{ $a->id }}">{{ $a->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Approver Level 2</label>
                        <select name="approver_2" class="form-select" required>
                            <option value="">-- Pilih Approver Level 2 --</option>
                            @foreach($approverLevel2 as $a)
                                <option value="{{ $a->id }}">{{ $a->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <button class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.vehicle-booking.index') }}" class="btn btn-danger">
                        Batal
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection