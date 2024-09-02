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
        Schema::table('routes', function (Blueprint $table) {
            $table->dropColumn('Name');
            $table->string('Origin', 50);
            $table->double('OriginLatitude', 10, 6);
            $table->double('OriginLongitude', 10, 6);
            $table->string('Destination', 50);
            $table->double('DestinationLatitude', 10, 6);
            $table->double('DestinationLongitude', 10, 6);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('routes', function (Blueprint $table) {
            $table->string('Name', 50);
            $table->dropColumn('Origin');
            $table->dropColumn('OriginLatitude');
            $table->dropColumn('OriginLongitude');
            $table->dropColumn('Destination');
            $table->dropColumn('DestinationLatitude');
            $table->dropColumn('DestinationLongitude');
        });
    }
};
