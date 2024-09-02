<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Checkin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class CheckinController extends Controller
{
    public function checkinIndex()
    {
        $checkins = Checkin::all();
        return view('driver.checkin', compact('checkins'));
    }
    public function checkoutIndex()
    {
        $checkins = Checkin::all();
        return view('driver.checkout', compact('checkins'));
    }

    public function checkinStore(Request $request)
    {
        $user = Auth::user();

        try {
            $checkin = new Checkin();
            $checkin->UserID = $user->id;
            $checkin->checkin_time = now();
            $checkin->status = 'work'; // Set status to 'work'
            $checkin->save();

            return response()->json(['success' => 'Check-in successful.']);
        } catch (QueryException $e) {
            // Handle the case where the trigger prevents the check-in
            return response()->json(['error' => 'You are already checked in.'], 404);
        }
    }

    public function checkoutStore(Request $request)
    {
        $user = Auth::user();

        try {
            $checkin = Checkin::where('UserID', $user->id)
                              ->whereNull('checkout_time')
                              ->orderBy('checkin_time', 'desc')
                              ->first();

            if ($checkin) {
                $checkin->checkout_time = now();
                $checkin->status = 'rest'; // Set status to 'rest'
                $checkin->save();

                return response()->json(['success' => 'Checkout successful.']);
            } else {
                return response()->json(['error' => 'No check-in found to check out.'], 404);
            }
        } catch (QueryException $e) {
            // Handle errors related to triggers or other issues
            return response()->json(['error' => 'Error during checkout.'], 500);
        }
    }

    public function events()
    {
        $checkins = Checkin::all();
        $events = [];

        foreach ($checkins as $checkin) {
            $events[] = [
                'title' => 'Check-in',
                'start' => $checkin->checkin_time->toDateTimeString(), // Correct 'tart' to 'start' and format date
                'end' => $checkin->checkout_time ? $checkin->checkout_time->toDateTimeString() : null,
            ];
        }

        return response()->json($events);
    }
    public function view()
{
    $userId = Auth::id(); // Get the ID of the currently authenticated user

    // Join Checkins with Users
    $checkins = Checkin::select('checkins.*', 'users.name as user_name') // Select columns from checkins and the user's name
        ->join('users', 'checkins.UserID', '=', 'users.id') // Join with the users table
        ->where('checkins.UserID', $userId) // Filter check-ins by the current user
        ->get();

    return view('driver.attendance', compact('checkins'));
}
}
