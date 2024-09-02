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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('BookingID'); // Primary key for the bookings table
            $table->unsignedBigInteger('UserID'); // Foreign key to users
            $table->unsignedBigInteger('ExternalBusID'); // Foreign key to external_buses
            $table->string('SeatNumber');// Number of seats booked
            $table->dateTime('BookingDate'); // Date and time of the booking
            $table->date('departure_date');
            $table->timestamps(); // Created and updated timestamps

            // Foreign key constraints
            $table->foreign('UserID')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ExternalBusID')->references('ExternalBusID')->on('external_buses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
