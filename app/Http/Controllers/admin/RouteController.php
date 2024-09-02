<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Route;
use App\Models\Schedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class RouteController extends Controller
{
    public function index()
    {
        $routes = Route::with('schedules')->get();
        return view('admin.route.view', compact('routes'));
    }
 


    public function create()
    {
        $schedules = Schedule::all();
        return view('admin.route.add', compact('schedules'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Origin' => 'required|string|max:50',
            'OriginLatitude' => 'required|numeric',
            'OriginLongitude' => 'required|numeric',
            'Destination' => 'required|string|max:50',
            'DestinationLatitude' => 'required|numeric',
            'DestinationLongitude' => 'required|numeric',
            'Description' => 'required|string|max:100',
        ]);


        try {
            DB::transaction(function () use ($validatedData) {
                DB::statement('CALL insert_route(?,?,?,?,?,?,?)', [
                    $validatedData['Origin'],
                    $validatedData['OriginLatitude'],
                    $validatedData['OriginLongitude'],
                    $validatedData['Destination'],
                    $validatedData['DestinationLatitude'],
                    $validatedData['DestinationLongitude'],
                    $validatedData['Description'],
                ]);
            });

            return redirect()->route('admin.route.view')->with('success', 'Route created successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::statement('CALL delete_route(?)', [$id]);

        return redirect()->route('admin.route.view')->with('success', 'Route deleted successfully.');
    }
}
