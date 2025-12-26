<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\VehicleBookingExport;
use App\Models\VehicleBooking;
use Maatwebsite\Excel\Facades\Excel;

class AdminReportController extends Controller
{
    public function index(){
        $bookings = VehicleBooking::with(['vehicle','driver','approvals'])->latest()->get();
        return view('admin.laporan.index', compact('bookings'));
    }
    public function exportBooking(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
        ]);

        return Excel::download(
            new VehicleBookingExport(
                $request->start_date,
                $request->end_date
            ),
            'laporan_pemesanan_kendaraan.xlsx'
        );
    }
}
