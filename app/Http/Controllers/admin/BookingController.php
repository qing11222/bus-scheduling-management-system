<?php

namespace App\Http\Controllers\Admin;
use App\Models\ExternalBus;
use App\Models\Seat;
use App\Models\Booking;
use App\Models\DepartureDate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
class BookingController extends Controller
{
    public function index()
    {
        $buses = DB::select('CALL GetBusesWithDepartureDates()');
        return view('user.booking.index',compact('buses'));
    }
    public function getSeats($busId)
    {
        // Retrieve the bus and its seats
        $bus = ExternalBus::findOrFail($busId);
        $seats = DB::select('CALL GetSeatsForBus(?)', [$busId]);
       // Retrieve and format departure dates
       $departureDates = DepartureDate::where('ExternalBusID', $busId)
                                  ->first(); // Use ->first() to get a single record
                                  if ($departureDates) {
                                    // Format the departure date
                                    $departureDates->formatted_date = Carbon::parse($departureDates->departure_date)->format('F j, Y'); // Format as "August 15, 2024"
                                } else {
                                    // Handle the case where no departure date is found
                                    $departureDate = new DepartureDate();
                                    $departureDate->formatted_date = 'No available dates'; // Or handle as appropriate
                                }

        return view('user.booking.seats', compact('bus', 'seats','departureDates'));
    }
    public function store(Request $request)
{
    try {
    // Validate request data
    $validatedData = $request->validate([
        'seat_id' => 'required|exists:seats,SeatID',
        'departure_date' => 'required|date',
        'bus_id' => 'required|exists:external_buses,ExternalBusID',
    ]);

    // Ensure user is authenticated
    if (!Auth::check()) {
        return response()->json(['success' => false, 'message' => 'User not authenticated.'], 401);
    }

    $user = Auth::user();
    $userId = $user->id;
    $seat = Seat::find($validatedData['seat_id']);
    $busId = $request->input('bus_id');

    // Check if the user already has a booking for this bus
    $existingBooking = Booking::where('UserID', $userId)
                              ->where('ExternalBusID', $busId)
                              ->first();

    if ($existingBooking) {
        return response()->json(['success' => false, 'message' => 'You have already booked a seat for this bus.']);
    }

    // Create booking
    $booking = new Booking();
    $booking->UserID = $user->id;
    $booking->ExternalBusID = $validatedData['bus_id']; // Ensure 'bus_id' is provided in the request
    $booking->SeatNumber = $seat->SeatNumber; // Adjust according to your seat model
    $booking->BookingDate = now(); // Set current date and time
    $booking->departure_date = $validatedData['departure_date']; // Ensure the date format is correct
    $booking->save();

    // Mark the seat as booked
    $seat->IsBooked = 1;
    $seat->save();

    // Fetch updated seats data
    $seats = Seat::where('ExternalBusID', $validatedData['bus_id'])->get();

    return response()->json(['success' => true, 'message' => 'Booking confirmed successfully.', 'seats' => $seats]);
} catch (QueryException $e) {
    // Check for the trigger error code
    if ($e->getCode() === '45000') {
        return response()->json(['success' => false, 'message' => 'You can only book one bus.'], 400);
    }

    // Handle other database exceptions
    return response()->json(['success' => false, 'message' => 'An error occurred. Please try again.'], 500);
}
}
}
