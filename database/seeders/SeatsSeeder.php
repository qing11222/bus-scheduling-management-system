<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\ExternalBus;
use App\Models\Seat;

class SeatsSeeder extends Seeder
{
    public function run()
    {
        // Retrieve all buses
        $buses = ExternalBus::all();

        foreach ($buses as $bus) {
            $capacity = $bus->Capacity; // Total number of seats in the bus
            $rows = ceil($capacity / 4); // Assuming 4 seats per row for simplicity

            for ($row = 1; $row <= $rows; $row++) {
                for ($col = 1; $col <= 4; $col++) { // 4 seats per row
                    $seatNumber = $row . chr(64 + $col); // Generate seat number (e.g., 1A, 1B)
                    if (($row - 1) * 4 + $col > $capacity) break; // Stop if capacity exceeded
                    Seat::create([
                        'ExternalBusID' => $bus->ExternalBusID,
                        'SeatNumber' => $seatNumber,
                        'IsBooked' => false,
                    ]);
                }
            }
        }
    }
}

