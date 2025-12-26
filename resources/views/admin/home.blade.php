@extends('admin.layout.app')

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
                <div class="card bg-dark text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                <div class="text-white-75 small">Total Kendaraan</div>
                                <div class="text-lg fw-bold">{{ $totalKendaraan }}</div>
                            </div>
                            <i class="feather-xl text-white-50" data-feather="truck"></i>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between small">
                        {{-- <a class="text-white stretched-link" href="#">View Report</a>
                        <div class="text-white"><i class="fas fa-angle-right"></i></div> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-3 mb-4">
                <div class="card bg-warning text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                <div class="text-white-75 small">Kendaraan Aktif</div>
                                <div class="text-lg fw-bold">{{ $kendaraanAktif }}</div>
                            </div>
                            <i class="feather-xl text-white-50" data-feather="check-circle"></i>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between small">
                        {{-- <a class="text-white stretched-link" href="#">View Report</a>
                        <div class="text-white"><i class="fas fa-angle-right"></i></div> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-3 mb-4">
                <div class="card bg-success text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                <div class="text-white-75 small">Total Pemesanan</div>
                                <div class="text-lg fw-bold">{{ $totalPemesanan }}</div>
                            </div>
                            <i class="feather-xl text-white-50" data-feather="clipboard"></i>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between small">
                        {{-- <a class="text-white stretched-link" href="#">View Report</a>
                        <div class="text-white"><i class="fas fa-angle-right"></i></div> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-3 mb-4">
                <div class="card bg-danger text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                <div class="text-white-75 small">Pending Approval</div>
                                <div class="text-lg fw-bold">{{ $pendingApproval }}</div>
                            </div>
                            <i class="feather-xl text-white-50" data-feather="clock"></i>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between small">
                        {{-- <a class="text-white stretched-link" href="#">View Report</a>
                        <div class="text-white"><i class="fas fa-angle-right"></i></div> --}}
                    </div>
                </div>
            </div>

            <!-- Chart Pemakaian Kendaraan -->
            <div class="row mt-4 g-3">
                <div class="col-12 col-xl-8 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <i data-feather="bar-chart-2" class="me-1"></i>
                            Grafik Pemakaian Kendaraan (Per Bulan)
                        </div>
                        <div class="card-body">
                            <canvas id="myBarChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <i data-feather="pie-chart" class="me-1"></i>
                            Status Kendaraan
                        </div>
                        <div class="card-body">
                            <canvas id="vehicleStatusPie"></canvas>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Tabel Pemesanan Terbaru -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card" style="width: 100%">
                        <div class="card-header">
                            <i data-feather="list" class="me-1"></i>
                            Pemesanan Kendaraan Terbaru
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table  id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Kode Booking</th>
                                            <th>Kendaraan</th>
                                            <th>Driver</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($latestBookings as $booking)
                                            <tr>
                                                <td>{{ $booking->booking_code }}</td>
                                                <td>{{ $booking->vehicle->merk ?? '-' }}</td>
                                                <td>{{ $booking->driver->nama ?? '-' }}</td>
                                                <td>{{ $booking->tanggal_mulai }} - {{ $booking->tanggal_selesai }}</td>
                                                <td>
                                                    @php
                                                        $status = optional($booking->approvals->first())->status;
                                                    @endphp

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
                                                <td colspan="5" class="text-center text-muted">
                                                    Belum ada pemesanan
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
    @push('scripts')
        <script>
            // ===== BAR CHART =====
            const months = @json($months);
            const totals = @json($totals);

            new Chart(document.getElementById('myBarChart'), {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Jumlah Pemesanan',
                        data: totals,
                        backgroundColor: 'rgba(13,110,253,0.6)',
                        borderColor: 'rgba(13,110,253,1)',
                        borderWidth: 1,
                        borderRadius: 8, // sudut rounded
                        maxBarThickness: 40
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            labels: {
                                color: '#495057',
                                font: {
                                    size: 12,
                                    weight: '500'
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: '#fff',
                            titleColor: '#212529',
                            bodyColor: '#212529',
                            borderColor: '#dee2e6',
                            borderWidth: 1
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#6c757d'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#f1f3f5'
                            },
                            ticks: {
                                color: '#6c757d'
                            }
                        }
                    }
                }
            });

            // ===== PIE CHART =====
            const statusLabels = @json($statusLabels);
            const statusTotals = @json($statusTotals);

            new Chart(document.getElementById('vehicleStatusPie'), {
                type: 'doughnut',
                data: {
                    labels: statusLabels,
                    datasets: [{
                        data: statusTotals,
                        backgroundColor: [
                            'rgba(25,135,84,0.6)', // hijau soft
                            'rgba(255,193,7,0.6)', // kuning soft
                            'rgba(220,53,69,0.6)' // merah soft
                        ],
                        borderColor: '#fff',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '65%', // efek donut modern
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: '#495057',
                                padding: 15
                            }
                        },
                        tooltip: {
                            backgroundColor: '#fff',
                            titleColor: '#212529',
                            bodyColor: '#212529',
                            borderColor: '#dee2e6',
                            borderWidth: 1
                        }
                    }
                }
            });
        </script>
    @endpush
@endsection
