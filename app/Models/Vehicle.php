<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $table = 'vehicles';

    protected $fillable = [
        'kode_kendaraan',
        'merk',
        'nomor_polisi',
        'jenis',
        'status'
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function bookings()
    {
        return $this->hasMany(VehicleBooking::class);
    }

    public function usages()
    {
        return $this->hasMany(VehicleUsage::class);
    }
}
