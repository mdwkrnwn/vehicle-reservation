<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        Vehicle::insert([
            [
                'kode_kendaraan' => 'VHC-001',
                'merk' => 'Toyota Avanza',
                'nomor_polisi' => 'N 1234 AB',
                'jenis' => 'angkutan_orang',
                'status' => 'tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_kendaraan' => 'VHC-002',
                'merk' => 'Mitsubishi Xpander',
                'nomor_polisi' => 'N 5678 CD',
                'jenis' => 'angkutan_orang',
                'status' => 'tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
