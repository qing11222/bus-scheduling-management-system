<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stop;
use App\Models\Schedule;
use App\Models\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
class StopController extends Controller
{

    public function index()
    {
        $stops = Stop::all();
        $routes = Route::all(); // Fetch all routes
        return view('admin.stop.view', compact('stops', 'routes'));
    }
    public function viewStop()
    {
        $stops = Stop::all();
        $routes = Route::all(); // Fetch all routes
        return view('user.stop', compact('stops', 'routes'));
    }

    public function create()
    {
        $schedules = Schedule::all();
        $routes = Route::all(); // retrieve all routes from the database

        return view('admin.stop.add', compact('schedules', 'routes'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'Name' => 'required|string|max:50',
            'Location' => 'required|string|max:50',
            'Latitude' => 'required|numeric|between:-90,90',
            'Longitude' => 'required|numeric|between:-180,180',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the file upload
        if ($request->hasFile('picture')) {
            $filePath = $request->file('picture')->store('public/pictures'); // Store file in 'storage/app/public/pictures'
            $validatedData['picture'] = Storage::url($filePath); // Get URL for saved file
        } else {
            // If no picture is provided, set a default value or null as needed
            $validatedData['picture'] = null;
        }

        // Call the stored procedure to insert the stop
        DB::statement('CALL insert_stop(?, ?, ?, ?, ?)', [
            $validatedData['Name'],
            $validatedData['Location'],
            $validatedData['Latitude'],
            $validatedData['Longitude'],
            $validatedData['picture']
        ]);

        // Redirect to the stops view with a success message
        return redirect()->route('admin.stop.view')->with('success', 'Bus Stop created successfully.');
    }

    public function delete($id)
    {
        // Retrieve the stop by its ID
        $stop = Stop::findOrFail($id);

        // Delete the associated picture file if it exists
        if ($stop->picture) {
            $picturePath = str_replace('/storage', 'public', $stop->picture); // Convert URL to storage path
            Storage::delete($picturePath); // Delete the file from storage
        }

        // Call the stored procedure to delete the stop
        DB::statement('CALL delete_stop(?)', [$id]);

        // Redirect to the stops view with a success message
        return redirect()->route('admin.stop.view')->with('success', 'Bus Stop deleted successfully.');
    }
}
