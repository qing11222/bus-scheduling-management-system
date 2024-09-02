<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class TicketController extends Controller
{
    public function show()
    {
        // Get the authenticated user's ID
    $userId = Auth::id();

    // Query to join external_buses, departure_dates, and seats tables
    $tickets = DB::table('bookings as b')
    ->join('external_buses as eb', 'b.ExternalBusID', '=', 'eb.ExternalBusID')
    ->join('users as u', 'b.UserID', '=', 'u.id')
    ->select('eb.NumberPlate', 'eb.Capacity', 'b.SeatNumber', 'b.BookingDate', 'b.departure_date', 'u.*')
    ->where('b.UserID', $userId)
    ->get();



    return view('user.ticket.view', compact('tickets'));
    }
}
