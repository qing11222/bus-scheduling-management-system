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
        Schema::create('buses', function (Blueprint $table) {
            $table->id('BusID');
            $table->string('NumberPlate');
            $table->integer('Capacity');
            $table->unsignedBigInteger('DriverID');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('DriverID')->references('DriverID')->on('drivers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buses');
    }
};
