<?php

namespace App\Http\Controllers;

use App\Models\BookingApproval;
use App\Models\Vehicle;
use App\Models\VehicleBooking;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $approvals = BookingApproval::with(['booking.vehicle', 'booking.driver'])
            ->where('approver_id', auth()->id())
            ->where('status', 'pending')
            ->get();

        return view('approve.index', compact('approvals'));
    }

    public function approve($id)
    {
        $approval = BookingApproval::with('booking.vehicle', 'booking.driver')
            ->findOrFail($id);

        if ($approval->approver_id !== auth()->id()) {
            abort(403);
        }

        // Approve approval ini
        $approval->update([
            'status' => 'approved',
            'approved_at' => now()
        ]);

        // Hitung approval
        $totalApproval = BookingApproval::where('vehicle_booking_id', $approval->vehicle_booking_id)->count();
        $approvedCount = BookingApproval::where('vehicle_booking_id', $approval->vehicle_booking_id)
            ->where('status', 'approved')
            ->count();

        // Jika SEMUA APPROVAL APPROVED
        if ($totalApproval === $approvedCount) {

            // Update booking
            $approval->booking->update([
                'status' => 'approved'
            ]);

            // 🔒 UPDATE VEHICLE
            $approval->booking->vehicle->update([
                'status' => 'dipakai' // SESUAI ENUM
            ]);

            // 🔒 UPDATE DRIVER
            $approval->booking->driver->update([
                'status' => 'tidak tersedia' // atau 'sibuk'
            ]);
        }

        return back()->with('success', 'Pemesanan disetujui.');
    }



    /**
     * Reject booking
     */
    public function reject($id)
    {
        $approval = BookingApproval::with('booking.vehicle', 'booking.driver')
            ->findOrFail($id);

        if ($approval->approver_id !== auth()->id()) {
            abort(403);
        }

        // Reject approval ini
        $approval->update([
            'status' => 'rejected',
            'approved_at' => now()
        ]);

        // Update booking
        $approval->booking->update([
            'status' => 'rejected'
        ]);

        // 🔓 VEHICLE KEMBALI TERSEDIA
        $approval->booking->vehicle->update([
            'status' => 'tersedia'
        ]);

        // 🔓 DRIVER KEMBALI AKTIF
        $approval->booking->driver->update([
            'status' => 'aktif'
        ]);

       
        BookingApproval::where('vehicle_booking_id', $approval->vehicle_booking_id)
            ->where('id', '!=', $approval->id)
            ->update(['status' => 'rejected']);

        return back()->with('success', 'Pemesanan berhasil ditolak.');
    }
}
