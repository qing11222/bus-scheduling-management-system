<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Queue\SerializesModels;
use App\Models\GpsData;

class DriverLocationUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $gpsData;

    public function __construct(GpsData $gpsData)
    {
        $this->gpsData = $gpsData;
    }

    public function broadcastOn()
    {
        return new Channel('bus-tracking');
    }

    public function broadcastAs()
    {
        return 'location.updated';
    }
}
