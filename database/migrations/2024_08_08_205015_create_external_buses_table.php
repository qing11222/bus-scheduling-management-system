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
        Schema::create('external_buses', function (Blueprint $table) {
            $table->id('ExternalBusID');
            $table->string('NumberPlate')->unique();
            $table->integer('Capacity');
            $table->string('Zone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('external_buses');
    }
};
