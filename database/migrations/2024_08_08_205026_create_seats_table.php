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
        Schema::create('seats', function (Blueprint $table) {
            $table->id('SeatID'); // Primary key for the seats table
            $table->unsignedBigInteger('ExternalBusID'); // Foreign key to external_buses
            $table->string('SeatNumber'); // Seat number (e.g., 1A, 1B, etc.)
            $table->boolean('IsBooked')->default(false); // Whether the seat is booked or not
            $table->timestamps(); // Created and updated timestamps

            // Foreign key constraint
            $table->foreign('ExternalBusID')->references('ExternalBusID')->on('external_buses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seats');
    }
};
