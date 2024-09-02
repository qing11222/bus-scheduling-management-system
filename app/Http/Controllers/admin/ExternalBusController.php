<?php

namespace App\Http\Controllers\Admin;

use App\Models\ExternalBus;
use App\Models\Seat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ExternalBusController extends Controller
{
    public function showBusSchedules()
    {
        $buses = ExternalBus::with('departureDate')->get();
        return view('admin.external_bus.view', compact('buses'));
    }

    public function edit($id)
    {
        $bus = ExternalBus::findOrFail($id);
        return view('admin.external_bus.edit', compact('bus'));
    }
    public function destroy(ExternalBus $bus)
    {
        $bus->delete();;

        return redirect()->route('admin.external_bus.view')->with('success', 'External bus deleted successfully.');
    }
    public function update(Request $request, ExternalBus $bus)
    {
        $request->validate([
            'NumberPlate' => 'required|string|max:255',
            'Capacity' => 'required|integer',
            'Zone' => 'required|string|max:255',
            'DepartureDate' => 'required|date',
        ]);

        try {
            // Attempt to update the bus record
            $bus->update([
                'NumberPlate' => $request->NumberPlate,
                'Capacity' => $request->Capacity,
                'Zone' => $request->Zone,
            ]);

            // Update the departure date if it exists
            if ($bus->departureDate) {
                $bus->departureDate->update(['departure_date' => $request->DepartureDate]);
            } else {
                $bus->departureDate()->create(['departure_date' => $request->DepartureDate]);
            }
            $this->updateSeats($bus, $request->Capacity);

            return redirect()->route('admin.external_bus.view')->with('success', 'External bus updated successfully.');
        } catch (QueryException $e) {
            // Check if the error message is related to the trigger
            if ($e->getCode() == '45000') {
                return redirect()->back()->with('error', 'Duplicate NumberPlate found in buses table.');
            }
            // Handle other exceptions
            return redirect()->back()->with('error', 'An error occurred while updating the external bus.');
        }
    }
    // Method to update seats based on new capacity
    protected function updateSeats(ExternalBus $bus, $newCapacity)
    {
        // First, delete existing seats
        Seat::where('ExternalBusID', $bus->ExternalBusID)->delete();

        $rows = ceil($newCapacity / 4); // Recalculate rows based on new capacity

        for ($row = 1; $row <= $rows; $row++) {
            for ($col = 1; $col <= 4; $col++) { // 4 seats per row
                $seatNumber = $row . chr(64 + $col); // Generate seat number (e.g., 1A, 1B)
                if (($row - 1) * 4 + $col > $newCapacity) break; // Stop if capacity exceeded

                Seat::create([
                    'ExternalBusID' => $bus->ExternalBusID,
                    'SeatNumber' => $seatNumber,
                    'IsBooked' => false,
                ]);
            }
        }
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'number_plate' => 'required|string|max:255',
            'capacity' => 'required|integer',
            'zone' => 'required|string|max:255',
        ]);

        // Extract data from the request
        $numberPlate = $request->input('number_plate');
        $capacity = $request->input('capacity');
        $zone = $request->input('zone');

        // Call the stored procedure
        DB::statement('CALL insert_external_bus(?, ?, ?)', [
            $numberPlate,
            $capacity,
            $zone
        ]);

        return redirect()->back()->with('success', 'Bus added successfully!');
    }
    public function create()
    {
        return view('admin.external_bus.add'); // Assuming this view is located at resources/views/admin/add_bus.blade.php
    }
}
