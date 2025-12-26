@extends('admin.layout.app')

@section('title', 'Laporan Pemesanan Kendaraan')

@section('content')
<div class="container-fluid px-4">

    {{-- PAGE HEADER --}}
    <h1 class="mt-4">Laporan Pemesanan Kendaraan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Laporan Periodik</li>
    </ol>

    {{-- FILTER & EXPORT --}}
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-filter me-1"></i>
            Filter Periode & Export
        </div>
        <div class="card-body">
            <form action="{{ route('admin.report.vehicle-booking.export') }}" method="POST" class="row g-3">
                @csrf

                <div class="col-md-4">
                    <label class="form-label">Dari Tanggal</label>
                    <input type="date" name="start_date" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Sampai Tanggal</label>
                    <input type="date" name="end_date" class="form-control" required>
                </div>

                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-success w-100">
                        <i class="fas fa-file-excel me-1"></i> Export Excel
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- TABLE REPORT --}}
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Data Pemesanan Kendaraan
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table ">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Kode Booking</th>
                            <th>Kendaraan</th>
                            <th>Driver</th>
                            <th>Tanggal Booking</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bookings as $booking)
                            @php
                                $status = optional($booking->approvals->first())->status;
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $booking->booking_code }}</td>
                                <td>{{ $booking->vehicle->merk ?? '-' }}</td>
                                <td>{{ $booking->driver->nama ?? '-' }}</td>
                                <td>{{ $booking->tanggal_mulai }} - {{ $booking->tanggal_selesai }}</td>
                                <td>
                                    @if ($status === 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif ($status === 'approved')
                                        <span class="badge bg-success">Approved</span>
                                    @elseif ($status === 'rejected')
                                        <span class="badge bg-danger">Rejected</span>
                                    @else
                                        <span class="badge bg-secondary">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    Tidak ada data pemesanan
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
