<?php

use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\BookingApprovalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\VehicleBookingController;

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/home', [HomeController::class, 'admin'])
            ->name('home');

        // Master Data
        Route::resource('/vehicle', VehicleController::class);
        Route::resource('/driver', DriverController::class);

        // Transaksi
        Route::resource('/vehicle-booking', VehicleBookingController::class);

        // Laporan
        Route::get('/report/vehicle-booking', [AdminReportController::class, 'index'])
            ->name('report.vehicle-booking');

        Route::post('/report/vehicle-booking/export', [AdminReportController::class, 'exportBooking'])
            ->name('report.vehicle-booking.export');
    });

Route::middleware(['auth', 'role:approver'])
    ->prefix('approver')
    ->group(function () {

        Route::get('/home', [HomeController::class, 'approver'])
            ->name('approve.home');
        Route::resource('booking-approval', BookingApprovalController::class);
        Route::post(
            '/booking/{id}/approve',
            [BookingApprovalController::class, 'approve']
        )
            ->name('approver.booking.approve');

        Route::post(
            '/booking/{id}/reject',
            [BookingApprovalController::class, 'reject']
        )
            ->name('approver.booking.reject');
    });
