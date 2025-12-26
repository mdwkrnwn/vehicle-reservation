@extends('admin.layout.app')

@section('content')
    <div class="container-xl px-4">
        <div class="card mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Data Kendaraan</span>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createModal">
                    <i class="fas fa-plus me-1"></i> Tambah Kendaraan
                </button>
            </div>

            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="table-responsive">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Merk</th>
                                <th>No Polisi</th>
                                <th>Jenis</th>
                                <th>Status</th>
                                <th width="120">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehicle as $v)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $v->kode_kendaraan }}</td>
                                    <td>{{ $v->merk }}</td>
                                    <td>{{ $v->nomor_polisi }}</td>
                                    <td>{{ $v->jenis }}</td>
                                    <td>
                                        <span
                                            class="badge bg-{{ $v->status == 'tersedia' ? 'success' : ($v->status == 'dipakai' ? 'warning' : 'danger') }}">
                                            {{ ucfirst($v->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-warning btn-sm mb-2 form-control" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $v->id }}">Edit <i
                                                class="fas fa-edit ms-2"></i>

                                        </button>

                                        <form action="{{ route('admin.vehicle.destroy', $v->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-danger btn-sm form-control"
                                                onclick="return confirm('Hapus kendaraan?')">
                                                Hapus <i class="fas fa-trash ms-2"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                {{-- MODAL EDIT --}}
                                <div class="modal fade" id="editModal{{ $v->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <form action="{{ route('admin.vehicle.update', $v->id) }}" method="POST">
                                            @csrf @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Kendaraan</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    @include('admin.vehicle.form', ['vehicle' => $v])
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                                    <button class="btn btn-primary">Simpan</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    {{-- MODAL CREATE --}}
    <div class="modal fade" id="createModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ route('admin.vehicle.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Kendaraan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        @include('admin.vehicle.form')
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
