@extends('approve.layout.app')

@section('content')
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="activity"></i></div>
                            Dashboard
                        </h1>
                        <div class="page-header-subtitle">Example dashboard overview and content summary</div>
                    </div>

                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-n10">

        <!-- Example Colored Cards for Dashboard Demo-->
        <div class="row">
            <div class="col-lg-6 col-xl-3 mb-4">
                <div class="card bg-yellow text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                <div class="text-white-75 small">Pending Approval</div>
                                <div class="text-lg fw-bold">{{ $pendingCount }}</div>
                            </div>
                            <i class="feather-xl text-white-50" data-feather="clock"></i>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between small">
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-xl-3 mb-4">
                <div class="card bg-success text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                <div class="text-white-75 small">Approved</div>
                                <div class="text-lg fw-bold">{{ $approvedCount }}</div>
                            </div>
                            <i class="feather-xl text-white-50" data-feather="check-circle"></i>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between small">
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-xl-3 mb-4">
                <div class="card bg-danger text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                <div class="text-white-75 small">Rejected</div>
                                <div class="text-lg fw-bold">{{ $rejectedCount }}</div>
                            </div>
                            <i class="feather-xl text-white-50" data-feather="x-circle"></i>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between small">
                    </div>
                </div>
            </div>

            <!-- Tabel Pemesanan Terbaru -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <i data-feather="list" class="me-1"></i>
                            Pemesanan Kendaraan Terbaru
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table ">
                                    <thead style="min-width: 900px;">
                                        <tr>
                                            <th>Kode Booking</th>
                                            <th>Kendaraan</th>
                                            <th>Driver</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($latestBookings as $b)
                                            <tr>
                                                <td>{{ $b->booking_code }}</td>
                                                <td>{{ $b->vehicle->merk ?? '-' }}</td>
                                                <td>{{ $b->driver->nama ?? '-' }}</td>
                                                <td>
                                                    {{ $b->tanggal_mulai }} <br>
                                                    s/d {{ $b->tanggal_selesai }}
                                                </td>
                                                <td>
                                                    @if($b->status == 'pending')
                                                        <span class="badge bg-warning">Pending</span>
                                                    @elseif($b->status == 'approved')
                                                        <span class="badge bg-success">Approved</span>
                                                    @else
                                                        <span class="badge bg-danger">Rejected</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">
                                                    Tidak ada data
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection