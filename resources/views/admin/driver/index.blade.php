@extends('admin.layout.app')

@section('content')
    <div class="container-xl px-4">
        <div class="card mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Data Driver</span>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createModal">
                    <i class="fas fa-plus me-1"></i> Tambah Driver
                </button>
            </div>

            <div class="card-body">

                {{-- ALERT --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button class="btn-close" data-bs-dismiss="alert"></button>
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
                        <thead style="min-width: 900px;">
                            <tr>
                                <th>No</th>
                                <th>Nama Driver</th>
                                <th>No HP</th>
                                <th>Status</th>
                                <th width="120">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($driver as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $d->nama }}</td>
                                    <td>{{ $d->no_hp ?? '-' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $d->status == 'aktif' ? 'success' : 'secondary' }}">
                                            {{ ucfirst($d->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-warning btn-sm form-control mb-2" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $d->id }}">
                                            Edit <i class="fas fa-edit ms-2"></i>
                                        </button>

                                        <form action="{{ route('admin.driver.destroy', $d->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-danger btn-sm form-control"
                                                onclick="return confirm('Hapus driver?')">
                                                Hapus <i class="fas fa-trash ms-2"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                {{-- MODAL EDIT --}}
                                <div class="modal fade" id="editModal{{ $d->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <form action="{{ route('admin.driver.update', $d->id) }}" method="POST">
                                            @csrf @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Driver</h5>
                                                    <button class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    @include('admin.driver.form', ['driver' => $d])
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
            <form action="{{ route('admin.driver.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Driver</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        @include('admin.driver.form')
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
