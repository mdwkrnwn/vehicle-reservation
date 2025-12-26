<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleBooking extends Model
{
    use HasFactory;
    protected $fillable = [
        'booking_code',
        'vehicle_id',
        'driver_id',
        'admin_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'keperluan',
        'status'
    ];


    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
    
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function approvals()
    {
        return $this->hasMany(BookingApproval::class);
    }
}
