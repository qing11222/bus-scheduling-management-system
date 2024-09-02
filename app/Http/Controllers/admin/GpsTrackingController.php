<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GpsData;
use Illuminate\Support\Facades\Auth;

class GpsTrackingController extends Controller
{
    public function updateLocation(Request $request)
{
    $request->validate([
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
    ]);

    $userId = Auth::id(); // Get the authenticated user's ID

    // Create a new record in the gps_data table
    GpsData::create([
        'UserID' => $userId,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'timestamp' => now()
    ]);

    return response()->json(['status' => 'success']);
}

    public function getLocationData()
{


    $locationDatas = GpsData::join('users', 'gps_data.UserID', '=', 'users.id')
    ->join('checkins', 'gps_data.UserID', '=', 'checkins.UserID')
    ->select('gps_data.latitude', 'gps_data.longitude', 'gps_data.timestamp', 'users.name as userName')
    ->where('checkins.status', 'work') // Filter to show only users with status 'work'
    ->whereNull('checkins.checkout_time') // Optionally, ensure that the check-in hasn't been checked out
    ->orderBy('gps_data.timestamp', 'desc')
    ->distinct()
    ->limit(10)
    ->get();

    return view('user.tracking', compact('locationDatas'));
}

}


