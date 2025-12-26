<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicle_usages', function (Blueprint $table) {
            $table->id();

            $table->foreignId('vehicle_id')
                ->constrained('vehicles')
                ->onDelete('cascade');

            $table->foreignId('vehicle_booking_id')
                ->constrained('vehicle_bookings')
                ->onDelete('cascade');

            $table->date('tanggal_pakai');
            $table->integer('km_awal')->nullable();
            $table->integer('km_akhir')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_usages');
    }
};
