<?php

namespace Database\Seeders;

use App\Models\Driver;
use Illuminate\Database\Seeder;

class DriverSeeder extends Seeder
{
    public function run(): void
    {
        Driver::insert([
            [
                'nama' => 'Budi Santoso',
                'no_telp' => '081234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Ahmad Fauzi',
                'no_telp' => '082345678901',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
