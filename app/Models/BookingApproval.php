<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingApproval extends Model
{
    protected $fillable = [
        'vehicle_booking_id', 
        'approver_id',
        'approval_level',
        'status',
        'approved_at',
    ];


    public function booking()
    {
        return $this->belongsTo(VehicleBooking::class, 'vehicle_booking_id');
    }
}
