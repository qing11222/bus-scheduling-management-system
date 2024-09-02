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
        Schema::create('stop_schedule', function (Blueprint $table) {
            $table->unsignedBigInteger('StopID');
            $table->unsignedBigInteger('ScheduleID');
            $table->primary(['StopID', 'ScheduleID']);
            $table->foreign('StopID')->references('StopID')->on('stops');
            $table->foreign('ScheduleID')->references('ScheduleID')->on('schedules');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stop_schedule');
    }
};
