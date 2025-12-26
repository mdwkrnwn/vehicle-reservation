@extends('approve.layout.app')

@section('content')

    <div class="container-xl px-4">
        <div class="card mt-4">

            <div class="card-header">
                <strong>Menunggu Persetujuan</strong>
            </div>

            <div class="card-body">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table" style="min-width: 900px;">
                        <thead class="">
                            <tr>
                                <th>No</th>
                                <th>Kode Booking</th>
                                <th>Kendaraan</th>
                                <th>Driver</th>
                                <th>Tanggal</th>
                                <th>Keperluan</th>
                                <th>Status</th>
                                <th width="160">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($approvals as $a)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $a->booking->booking_code }}</td>
                                    <td>{{ $a->booking->vehicle->merk }}</td>
                                    <td>{{ $a->booking->driver->nama }}</td>
                                    <td>
                                        {{ $a->booking->tanggal_mulai }} <br>
                                        s/d {{ $a->booking->tanggal_selesai }}
                                    </td>
                                    <td>{{ $a->booking->keperluan }}</td>
                                    <td>
                                        <span class="badge bg-warning">Pending</span>
                                    </td>
                                    <td>
                                        <form action="{{ route('approver.booking.approve', $a->id) }}" method="POST" class="mb-1">
                                            @csrf
                                            <button class="btn btn-success btn-sm w-100">
                                                Approve
                                            </button>
                                        </form>
                                        <form action="{{ route('approver.booking.reject', $a->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-danger btn-sm w-100" onclick="return confirm('Tolak pemesanan ini?')">
                                                Reject
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">
                                        Tidak ada pemesanan yang menunggu persetujuan
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection