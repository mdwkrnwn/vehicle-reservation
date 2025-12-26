<?php

namespace App\Http\Controllers;

use App\Models\booking_approval;
use App\Models\Driver;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleBooking;
use App\Models\BookingApproval;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VehicleBookingController extends Controller
{
    public function index()
    {
        $bookings = VehicleBooking::with('vehicle')
            ->latest()
            ->get();

        return view('admin.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $vehicles = Vehicle::where('status', 'tersedia')->get();
        $drivers = Driver::where('status', 'aktif')->get();
        $approverLevel1 = User::where('role', 'approver')
            ->where('approval_level', 1)
            ->get();

        $approverLevel2 = User::where('role', 'approver')
            ->where('approval_level', 2)
            ->get();

        return view('admin.bookings.create', compact(
            'vehicles',
            'drivers',
            'approverLevel1',
            'approverLevel2'
        ));
    }


    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'required|exists:drivers,id', 
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'keperluan' => 'required',
            'approver_1' => 'required|exists:users,id',
            'approver_2' => 'required|exists:users,id',
        ]);


        $booking = VehicleBooking::create([
            'booking_code' => 'BK-' . strtoupper(Str::random(6)),
            'vehicle_id' => $request->vehicle_id,
            'driver_id' => $request->driver_id, 
            'admin_id' => auth()->id(),
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'keperluan' => $request->keperluan,
            'status' => 'pending'
        ]);

        // Approval level 1
        BookingApproval::create([
            'vehicle_booking_id' => $booking->id,
            'approver_id' => $request->approver_1,
            'approval_level' => 1
        ]);

        // Approval level 2
        BookingApproval::create([
            'vehicle_booking_id' => $booking->id,
            'approver_id' => $request->approver_2,
            'approval_level' => 2
        ]);

        return redirect()
            ->route('admin.vehicle-booking.index')
            ->with('success', 'Pemesanan kendaraan berhasil dibuat.');
    }
}
