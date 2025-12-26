<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\BookingApproval;
use App\Models\VehicleBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    // Dashboard ADMIN
    public function admin()
    {
        $bookingPerMonth = VehicleBooking::whereYear('tanggal_mulai', date('Y'))
            ->whereDoesntHave('approvals', function ($q) {
                $q->where('status', '!=', 'approved');
            })
            ->selectRaw('MONTH(tanggal_mulai) as month, COUNT(*) as total')
            ->groupByRaw('MONTH(tanggal_mulai)')
            ->orderBy('month')
            ->get();



        $months = [];
        $totals = [];

        foreach ($bookingPerMonth as $row) {
            $months[] = date('M', mktime(0, 0, 0, $row->month, 1)); // Jan, Feb, dst
            $totals[] = $row->total;
        }

        // Pie chart status kendaraan
        $vehicleStatus = Vehicle::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->get();

        $statusLabels = $vehicleStatus->pluck('status');
        $statusTotals = $vehicleStatus->pluck('total');

        $totalKendaraan = Vehicle::count();
        $kendaraanAktif = Vehicle::where('status', 'tersedia')->count();
        $totalPemesanan = VehicleBooking::count();
        $pendingApproval = BookingApproval::where('status', 'pending')->count();
        $latestBookings = VehicleBooking::with(['vehicle', 'driver', 'approvals'])
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.home', compact(
            'totalKendaraan',
            'kendaraanAktif',
            'totalPemesanan',
            'pendingApproval',
            'latestBookings',
            'months',
            'totals',
            'statusLabels',
            'statusTotals'
        ));
    }

    // Dashboard APPROVER
    public function approver()
    {
        $userId = auth()->id();

        // SUMMARY
        $pendingCount = BookingApproval::where('approver_id', $userId)
            ->where('status', 'pending')
            ->count();

        $approvedCount = BookingApproval::where('approver_id', $userId)
            ->where('status', 'approved')
            ->count();

        $rejectedCount = BookingApproval::where('approver_id', $userId)
            ->where('status', 'rejected')
            ->count();


        // PEMESANAN TERBARU (LIMIT 5)
        $latestBookings = VehicleBooking::with(['vehicle', 'driver'])
            ->whereHas('approvals', function ($q) use ($userId) {
                $q->where('approver_id', $userId);
            })
            ->latest()
            ->limit(5)
            ->get();

        return view('approve.home', compact(
            'pendingCount',
            'approvedCount',
            'rejectedCount',
            'latestBookings'
        ));
    }
}
