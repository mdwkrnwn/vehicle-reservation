@extends('admin.layout.app')

@section('content')
    <div class="container-xl px-4">
        <div class="card mt-4">
            <div class="card-header d-flex justify-content-between">
                <span>Transaksi Pemesanan Kendaraan</span>
                <a href="{{ route('admin.vehicle-booking.create') }}" class="btn btn-success ">
                    Tambah Pemesanan
                </a>
            </div>

            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table id="datatablesSimple">
                        <thead style="min-width: 900px;">
                            <tr>
                                <th>Kode</th>
                                <th>Kendaraan</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $b)
                                <tr>
                                    <td>{{ $b->booking_code }}</td>
                                    <td>{{ $b->vehicle->kode_kendaraan }}</td>
                                    <td>{{ $b->tanggal_mulai }} s/d {{ $b->tanggal_selesai }}</td>
                                    <td>
                                        <span class="badge bg-warning">
                                            {{ ucfirst($b->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
