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
        Schema::create('departure_dates', function (Blueprint $table) {
            $table->id('DepartureDateID');
            $table->date('departure_date');
            $table->unsignedBigInteger('ExternalBusID');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('ExternalBusID')
                  ->references('ExternalBusID')
                  ->on('external_buses')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departure_dates');
    }
};
