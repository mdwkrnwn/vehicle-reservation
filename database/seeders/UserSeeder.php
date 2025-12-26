<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Approver Level 1',
                'email' => 'ap1@gmail.com',
                'password' => Hash::make('approver2'),
                'role' => 'approver',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Approver Level 2',
                'email' => 'ap2@gmail.com',
                'password' => Hash::make('approver2'),
                'role' => 'approver',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
